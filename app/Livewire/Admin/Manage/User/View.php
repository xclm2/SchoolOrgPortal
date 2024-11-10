<?php
namespace App\Livewire\Admin\Manage\User;

use App\Livewire\Admin\Manage\User\Create;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class View extends Create
{
    public function mount(int $id)
    {
        $this->user = User::findOrFail($id);
        $this->name = $this->user->name;
        $this->lastname = $this->user->lastname;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        $this->role = $this->user->role;
        $this->course_id = $this->user->course_id;
    }

    public function save()
    {
        $attributes = $this->validate();
        $this->user->update($attributes);
        $this->dispatch('$refresh');
        $this->dispatch('admin-updated-user');
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules['email'] = ['required', 'email', Rule::unique('users')->ignore($this->user->id)];
        $rules['phone'] = ['required', 'numeric', 'digits:10', Rule::unique('users')->ignore($this->user->id)];

        return $rules;
    }
}
