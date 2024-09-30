<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Organization;
use App\Models\Organization\Member as OrganizationMember;
use App\Models\User;
use App\Notifications\Organization\NewMember;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Registration extends Component
{

    public bool $isSubmitted = false;
    public ?int $organization_id;
    public string $name;
    public string $lastname;
    public string $email;
    public string $password;
    public string $phone;
    public int $course_id;
    public int|string $year;
    public string $role = User::ROLE_STUDENT;
    public string $selected_org = 'Select Organization';

    public function mount($organizationId = null)
    {
        $this->organization_id = $organizationId;
        if (! empty($organizationId)) {
            $organization = Organization::findOrFail($organizationId);
            $this->selectOrg($organizationId, $organization->name);
            if (! is_null($organization->course_id)) {
                $this->course_id = $organization->course_id;
            }
        }
    }

    public function render()
    {
        return view('livewire.registration', [
            'organizations' => Organization::all()->where('status', '=', Organization::STATUS_ACTIVE),
            'courses' => Course::all(),
        ]);
    }

    public function updated($property)
    {
        if ($property == 'course_id') {
            $this->selected_org = 'Select Organization';
            $this->organization_id = null;
        }
    }

    public function selectOrg($id, $name)
    {
        $this->organization_id = $id;
        $this->selected_org = $name;
    }

    public function save()
    {
        $this->isSubmitted = true;
        $attributes = $this->validate();

        $attributes['password'] = bcrypt($attributes['password'] );

        session()->flash('success', 'Your account has been created.');
        $user = User::create($attributes);
        if ($this->role == User::ROLE_STUDENT) {
            $newMember = OrganizationMember::create(['user_id' => $user->id, 'organization_id' => $this->organization_id]);
            /** @var Organization $organization */
            $organization = Organization::findOrFail($this->organization_id);
            Notification::send($organization->getAdviser(), new NewMember($newMember));
        }

        Auth::login($user);
        return $this->redirect('/', navigate: true);
    }

	public function getLogo($id)
	{
        $logo = "storage/logo/org-$id.jpg";
        if (! file_exists($logo)) {
            $logo = "images/placeholder.svg";
        }

		return asset($logo);
	}

    public function rules()
    {
        return [
            'name' => ['required', 'max:50'],
            'lastname' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'course_id' => ['required', Rule::exists('courses', 'id')],
            'phone' => ['required', 'numeric', 'digits:10', Rule::unique('users', 'phone')],
            'role' => ['required', Rule::in([User::ROLE_ADVISER, User::ROLE_STUDENT])],
            'organization_id' => [
                'exclude_if:role,' . User::ROLE_ADVISER,
                'required',
                function (string $attribute, $value, \Closure $fail) {
                    if (is_null(Organization::find($value))) {
                        $fail('Organization not found.');
                    }
                }
            ],
        ];
    }
}
