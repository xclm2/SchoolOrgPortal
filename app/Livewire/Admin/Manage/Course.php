<?php
namespace App\Livewire\Admin\Manage;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Course as CourseModel;

class Course extends Component
{
    #[Validate('required|min:3')]
    public ?string $name = null;
    public bool $isEdit = false;
    public ?int $courseID = null;
    public function render()
    {
        return view('admin.course', ['courses' => CourseModel::all()]);
    }

    public function save()
    {
        $this->validate();
        CourseModel::updateOrCreate(
            ['id' => $this->courseID],
            ['name' => $this->name]
        );

        $this->courseID = null;
        $this->name = null;
        $this->dispatch('$refresh');
    }

    public function edit(int $courseID, string $name)
    {
        $this->courseID = $courseID;
        $this->name = $name;
    }

    public function cancelEdit()
    {
        $this->courseID = null;
        $this->name = null;
    }
}
