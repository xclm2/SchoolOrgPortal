<?php
namespace App\Livewire\Admin\Manage\Organization;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Organization $organization;

    public string $name = '';
    public string $description = '';
    public int $adviser_id;
    public string $adviser_name = '';
    public $logo;
    public $banner;

    public bool $updateMode = false;

    public function mount($id = null)
    {
        try {
            $this->organization = Organization::findOrFail($id);
            $this->updateMode = true;
            $this->_initData();
        } catch (ModelNotFoundException $e) {
            $this->organization = new Organization();
        }
    }

    public function save()
    {
        $validated = $this->validate();

        $org = Organization::updateOrCreate(['id' => $this->organization->id], $validated);
        $this->_saveImages($org->id);
        return $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('admin.org-management.create');
    }

    public function rules()
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'adviser_id' => [
                'required',
                function (string $attribute, $value, \Closure $fail) {
                    $this->_validateAdviser($attribute, $value, $fail);
                }
            ],
        ];

        if (! is_string($this->logo)) {
            $rules['logo'] = 'image|mimes:jpeg,png,jpg,svg|max:2048';
        }

        if (! is_string($this->banner)) {
            $rules['banner'] = 'image|mimes:jpeg,png,jpg,svg|max:2048';
        }

        return $rules;
    }

    private function _initData()
    {
        $user = User::find($this->organization?->adviser_id);
        $this->name = $this->organization?->name ?? '';
        $this->adviser_name = $user->getFullname() ?? '';
        $this->description = $this->organization?->description ?? '';
        $this->adviser_id = $this->organization?->adviser_id ?? 0;
        if ($id = $this->organization?->id) {
            $this->banner = (is_null($this->banner)) ? asset("storage/banner/org-$id.jpg") : $this->banner;
            $this->logo = (is_null($this->logo)) ? asset("storage/logo/org-$id.jpg") : $this->logo;
        }
    }

    protected function _validateAdviser(string $attribute, $value, \Closure $fail)
    {
        $user = User::find($value);
        $org = Organization::where('adviser_id', $value);

        if (is_null($user) || $user->getAttribute('role') !== 'adviser') {
            $fail('Selected user cannot be added as organization adviser');
        }

        if ($this->updateMode) {
            if ($this->organization->adviser_id != $value && $org->count() > 0) {
                $fail('Selected user is already an adviser to an organization');
            }
        } else if ($org->count() > 0) {
            $fail('Selected user is already an adviser to an organization');
        }
    }

    protected function _saveImages($orgID)
    {
        if (! is_string($this->logo)) {
            $this->logo->storeAs('logo', "org-$orgID.jpg", 'public');
        }

        if (! is_string($this->banner)) {
            $this->banner->storeAs('banner', "org-$orgID.jpg", 'public');
        }
    }
}
