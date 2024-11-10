<?php
namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class Login extends Component
{
    public string $email = 'admin@bcc.com';
    public string $resetPassEmail = '';
    public string $password = 'secret';

    public function render()
    {
        return view('session.login-session');
    }

    public function login()
    {
        $attributes = $this->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(Auth::attempt($attributes))
        {
            session()->regenerate();

            if (Auth::user()->getAttribute('role') == 'admin') {
                $this->redirect('/admin');
                return;
            }

            $this->redirect('/', navigate: true);
        } else{
            $this->addError('email', 'Invalid email or password');
        }
    }

    public function forgotPassword()
    {
        $this->validate(['resetPassEmail' => 'required|email']);
        $status = Password::sendResetLink(['email' => $this->resetPassEmail]);
        if ($status === Password::RESET_LINK_SENT) {
            $this->dispatch('reset-password-link-sent');
        } elseif ($status === Password::INVALID_USER) {
            $this->addError('resetPassEmail', 'Email not found');
        } else {
            $this->addError('resetPassEmail', 'Unknown error');
        }

    }
}
