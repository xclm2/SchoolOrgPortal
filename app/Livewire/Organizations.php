<?php
namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;

class Organizations extends Component
{
    public function render()
    {
        $courses = [];
        foreach (Course::all() as $course) {
            $courses[$course->id] = $course->name;
        }

        return view('guest.organizations.index', [
            'organizations' => \App\Models\Organization::all(),
            'courses' => $courses,
        ]);
    }

    public function getAvatar($userId)
    {
        $filePath = "storage/avatar/$userId.jpg";
        if (file_exists($filePath)) {
            return asset($filePath);
        }

        return asset("images/profile.png");
    }
}
