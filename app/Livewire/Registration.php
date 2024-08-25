<?php

namespace App\Livewire;

use App\Models\Organization;
use App\Models\Organization\Member as OrganizationMember;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class Registration extends Component
{

    public bool $isSubmitted = false;
    public int|string $organization_id;
    public string $name;
    public string $lastname;
    public string $email;
    public string $password;
    public string $phone;
    public int $course;
    public int|string $year;

    public function render()
    {
        return view('livewire.registration', ['organizations' => Organization::all()]);
    }

    public function save()
    {
        $this->isSubmitted = true;
        $attributes = $this->validate();

        $attributes['password'] = bcrypt($attributes['password'] );


        session()->flash('success', 'Your account has been created.');
        $user = User::create($attributes);
        OrganizationMember::create(['user_id' => $user->id, 'organization_id' => $this->organization_id]);
        Auth::login($user);
        return $this->redirect('/', navigate: true);
    }
	
	public function getLogo($id)
	{
		return asset("storage/logo/org-$id.jpg");
	}

    public function rules()
    {
        return [
            'name' => ['required', 'max:50'],
            'lastname' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'organization_id' => [
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
