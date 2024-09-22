<?php
namespace App\Livewire;

use App\Models\Course;
use App\Models\Organization;
use Livewire\Component;

class Organizations extends Component
{
    public function render()
    {
        $courses = [];
        foreach (Course::all() as $course) {
            $courses[$course->id] = $course->name;
        }

        return view('guest.organization.index', [
            'organizations' => Organization::all()->where('status', '=', Organization::STATUS_ACTIVE),
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
