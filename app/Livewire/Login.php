<?php
namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public string $email = 'admin@softui.com';
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
                return $this->redirect('/admin', navigate: true);
            }

            return $this->redirect('/', navigate: true);
        }
        else{

            return back()->withErrors(['email'=>'Email or password invalid.']);
        }
    }
}
