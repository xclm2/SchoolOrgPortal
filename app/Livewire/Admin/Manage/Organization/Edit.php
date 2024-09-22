<?php
namespace App\Livewire\Admin\Manage\Organization;

use App\Livewire\Admin\AbstractComponent;
use App\Models\Course;
use App\Models\Organization;
use App\Models\Organization\Member;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Session;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Edit extends AbstractComponent
{
    use WithFileUploads, WithPagination;

    public Organization $organization;

    public string $name = '';
    public string $description = '';
    public string $adviser_name = '';
    public string $status = 'active';
    public ?int $adviser_id;
    public ?int $course_id;
    public $logo;
    public $banner;
    public bool $isAdmin = true;

    #[Session]
    public string $FILTER_NAME = '';
    #[Session]
    public string $FILTER_LASTNAME = '';
    #[Session]
    public string $FILTER_EMAIL = '';

    public bool $updateMode = false;

    public function mount($id = null)
    {
        try {
            $this->organization = Organization::findOrFail($id);
            $this->updateMode = true;
            $this->status = $this->organization->status;
            $this->_initData();
        } catch (ModelNotFoundException $e) {
            $this->organization = new Organization();
            $this->banner =  $this->getImage('dummy', 'banner');
            $this->logo = $this->getImage('dummy', 'logo');
        }
    }

    public function save()
    {
        $validated = $this->validate();
        $org = Organization::updateOrCreate(['id' => $this->organization->id], $validated);
        if (! empty($validated['adviser_id'])) {
            Organization\Member::updateOrCreate(
                ['organization_id' => $org->id],
                [ 'user_id' => $validated['adviser_id'], 'status' => Member::STATUS_ACTIVE]
            );
        }

        $this->_saveImages($org->id);
        $this->dispatch('$refresh');
        $this->dispatch('organization-saved');
    }

    public function render()
    {
        return view('admin.org-management.create', [
            'members' => $this->organization->getAllMembers()->paginate(10, ['*'], 'members'),
            'courses' => Course::all(),
            'advisers' => $this->advisers()->paginate(10, ['*'], 'advisers'),
        ]);
    }

    public function advisers(): Builder
    {
        $users = DB::table('users')->select('users.*')
            ->leftJoin('organization as org', 'org.adviser_id', '=', 'users.id')
            ->whereRaw("org.adviser_id IS NULL AND users.role = '" .User::ROLE_ADVISER. "'");

        if ($this->FILTER_NAME) {
            $users->where('users.name', 'like', '%' . $this->FILTER_NAME . '%');
        }

        if ($this->FILTER_LASTNAME) {
            $users->where('users.lastname', 'like', '%' . $this->FILTER_LASTNAME . '%');
        }

        if ($this->FILTER_EMAIL) {
            $users->where('users.email', 'like', '%' . $this->FILTER_EMAIL . '%');
        }


        return $users;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'course_id' => 'numeric|nullable',
            'status' => 'required|in:active,inactive',
            'adviser_id' => [
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
        $this->name = $this->organization?->name ?? '';
        $this->description = $this->organization?->description ?? '';
        $this->adviser_id = $this->organization?->adviser_id;
        $this->course_id = $this->organization?->course_id;
        if ($this->adviser_id) {
            $user = User::find($this->adviser_id);
            $this->adviser_name = $user->getFullname() ?? '';
        }

        $this->banner = (is_null($this->banner)) ? $this->getImage($this->organization?->id, 'banner') : $this->banner;
        $this->logo = (is_null($this->logo)) ? $this->getImage($this->organization?->id, 'logo') : $this->logo;
    }

    protected function _validateAdviser(string $attribute, $value, \Closure $fail)
    {
        $user = User::find($value);
        $org = Organization::where('adviser_id', $value);
        if (empty($value)) {
            return;
        }
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

    public function exportCsv()
    {
        $filename = 'organization-' . $this->organization->id . '-members.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return response()->stream(function () {
            $handle = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($handle, [
                'ID',
                'Organization',
                'Name',
                'Email',
                'Phone Number',
            ]);

            // Fetch and process data in chunks
            $this->organization->getAllMembers()->chunk(25, function ($members) use ($handle) {
                foreach ($members as $member) {
                    // Extract data from each employee.
                    $fullName = "{$member->name} $member->lastname";
                    $data = [
                        $member->id,
                        $this->organization->name,
                        $fullName,
                        $member?->email ?? '',
                        $member?->phone ?? '',
                    ];

                    // Write data to a CSV file.
                    fputcsv($handle, $data);
                }
            });

            // Close CSV file handle
            fclose($handle);
        }, 200, $headers);
    }
}
