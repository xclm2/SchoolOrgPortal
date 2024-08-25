<?php
namespace App\Livewire\Member;

use App\Models\Organization;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class Profile extends AbstractMember
{
    use WithFileUploads;
    public $profilePicture;
    public string $name;
    public string $email;
    public string $password;
    public ?string $phone;
    public ?string $lastname;
    public string $currentPassword;

    public function mount()
    {
        $user = $this->getCurrentUser();
        $this->profilePicture = $this->getAvatar($user->id);
        $this->name = $user->name;
        $this->lastname = $user->lastname;
        $this->email = $user->email;
        $this->phone = $user->phone;
    }

    public function render()
    {
        return view('member.profile', ['user' => $this->getCurrentUser()]);
    }

    public function save()
    {
        $this->validate();
        $user = $this->getCurrentUser();
        $user->phone = $this->phone;
        $user->lastname = $this->lastname;
        $user->name = $this->name;
        $user->save();

        if (! is_string($this->profilePicture)) {
            $this->profilePicture->storeAs('avatar', "{$user->id}.jpg", 'public');
        }

        $this->dispatch('profile-saved');
    }

    public function rules()
    {
        return [
            'name' => ['required', 'max:50'],
            'lastname' => ['required', 'max:50'],
            'phone' => 'numeric|min_digits:10|max_digits:13',
        ];
    }

    public function changePassword()
    {
        $result = $this->validate([
            'currentPassword' => [
                'required',
                function ($attribute, $value, $fail) {

                }
            ],
        ]);
    }
}
