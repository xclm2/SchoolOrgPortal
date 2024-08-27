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

    public function render()
    {
        return view('admin.user-management.create', ['courses' => Course::all()]);
    }

    public function save()
    {
        $attributes = $this->validate();
        $attributes['password'] = bcrypt('sample');
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
            'phone' => 'numeric|min_digits:10|max_digits:10',
        ];
    }
}
