<?php
namespace App\Livewire\Admin\Manage\User;

use App\Models\Course;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public string $email;
    public string $name;
    public string $lastname;
    public string $role;
    public string $phone;
    public $course_id;
    public string $password;

    public function mount()
    {
        $this->password = $this->randomPassword();
    }

    public function render()
    {
        return view('admin.user-management.create', ['courses' => Course::all()]);
    }

    public function save()
    {
        $attributes = $this->validate();
        $attributes['password'] = bcrypt($this->password);
        User::create($attributes);
        $this->dispatch('$refresh');
        $this->dispatch('admin-created-user');
    }

    public function rules()
    {
        return [
            'name' => ['required', 'max:50'],
            'lastname' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'role' => ['required'],
            'course_id' => 'numeric|required',
            'phone' => ['required', 'numeric', 'digits:10', Rule::unique('users', 'phone')],
        ];
    }

    public function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }

        return implode($pass); //turn the array into a string
    }
}
