<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Organization;
use App\Models\Organization\Member as OrganizationMember;
use App\Models\User;
use App\Notifications\Notify;
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

	public int $agree_terms = 0;

	public string $_otpCode = '';
	private ?\DateTime $_otpGenerated = null;
	public string $otp_input = '';
	public bool $otpSent = false;
	public ?bool $otpValidated = null;

	protected $listeners = ['resend-otp' => 'sendOtp'];

	public function mount($organizationId = null)
	{
		$this->organization_id = $organizationId;
		if (!empty($organizationId)) {
			$organization = Organization::findOrFail($organizationId);
			$this->selectOrg($organizationId, $organization->name);
			if (!is_null($organization->course_id)) {
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

		$attributes['password'] = bcrypt($attributes['password']);
		session()->flash('success', 'Your account has been created.');
		$user = User::create($attributes);
		if ($this->role == User::ROLE_STUDENT) {
			$newMember = OrganizationMember::create(['user_id' => $user->id, 'organization_id' => $this->organization_id]);

			/** @var Organization $organization */
			$organization = Organization::findOrFail($this->organization_id);
            if ($organization->getAdviser() != null) {
                Notification::send($organization->getAdviser(), new NewMember($newMember));

                $messaging = new \App\Events\NewMember('new_member_org_' . $organization->id, json_encode([]));
                broadcast($messaging)->toOthers();
            }
		}

		Auth::login($user);
		$this->dispatch('show-loading');
		return $this->redirect('/', navigate: true);
	}

	public function validateForm()
	{
		$this->validate();
		$this->sendOtp();
	}

	public function sendOtp()
	{
		$otp = '';
		for ($i = 0; $i < 6; $i++) {
			$otp .= mt_rand(0, 9); // Generates a digit between 0 and 9
		}

		$this->_otpCode = $otp;
		$this->dispatch('verify-phone-num');
        $notify = new Notify();
        $notify->sendOtp($otp, $this->email, $this->phone);
        $this->otpSent = true;
	}

	public function validateOtp()
	{
		if (! empty($this->_otpCode) && $this->_otpCode === $this->otp_input) {
			$this->otpValidated = true;
			$this->dispatch('opt-validated');
			$this->save();
		}

		$this->otpValidated = false;
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
			'agree_terms' => ['required', Rule::in([1])]
        ];
    }
}
