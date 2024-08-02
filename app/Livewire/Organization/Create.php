<?php

namespace App\Livewire\Organization;

use App\Models\Organization;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name = '';
    public $description = '';
    public $adviser_id;

    #[Validate('image')]
    public $logo;

    #[Validate('image')]
    public $banner;

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required',
            'description' => 'required',
            'adviser_id' => [
                'required',
                function (string $attribute, $value, \Closure $fail) {
                    $user = User::find($value);
                    if (is_null($user) || $user->getAttribute('type') !== 'adviser') {
                        $fail('Selected user cannot be added as organization adviser');
                    }

                    $org = Organization::where('adviser_id', $value);
                    if ($org->count() > 0) {
                        $fail('Selected user is already an adviser to an organization');
                    }
                }
            ]
        ]);

        $org = Organization::create($validated);
        $this->logo->storeAs('logo', "org-{{$org->id}}.jpg", 'public');
        $this->banner->storeAs('banner', "org-{{$org->id}}.jpg", 'public');

        return redirect()->route('organization.index');
    }

    #[On('adviser-selected')]
    public function adviserSelected($adviserId)
    {
        return $adviserId;
    }

    public function render()
    {
        return view('admin.org-management.component.create-form');
    }
}
