<?php
namespace App\Livewire;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Component;
use function Symfony\Component\String\s;

class ResetPassword extends Component
{
    public string $token;
    public string $password;
    public string $confirm_password;
    public string $email;


    public function mount($token)
    {
        $this->token = $token;
    }

    public function changePassword()
    {
        $validated = $this->validate([
            'token' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
            'email' => 'required|email'
        ]);

        $status = Password::reset(
            $validated,
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        switch ($status) {
            case Password::PASSWORD_RESET:
                $this->dispatch('password-reset-success');
                break;
            case Password::INVALID_TOKEN:
                $this->addError('email', trans(Password::INVALID_TOKEN));
                break;
            case Password::INVALID_USER:
                $this->addError('email', trans(Password::INVALID_USER));
                break;
        }
    }

    public function render()
    {
        return view('livewire.reset-password');
    }
}
