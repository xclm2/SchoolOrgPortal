<?php
namespace App\Livewire\Member;

use Livewire\Attributes\Validate;
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
    public string $new_password;
    #[Validate('same:new_password', message: 'Please ensure both fields contain the same password.')]
    public string $confirm_password;

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
            'phone' => 'required|numeric|digits:10',
        ];
    }

    public function changePassword()
    {
        $result = $this->validate([
            'currentPassword' => 'current_password',
            'new_password' => ['required', 'min:5', 'max:20'],
            'confirm_password' => ['required', 'same:new_password'],
        ]);

        $user = $this->getCurrentUser();
        $user->password = bcrypt($result['new_password']);
        $user->save();

        $this->dispatch('password-saved');
        $this->currentPassword = '';
        $this->new_password = '';
        $this->confirm_password = '';
    }
}
