<?php
namespace App\Livewire\Admin\Manage;

use App\Livewire\Admin\AbstractComponent;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Session;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class User extends AbstractComponent
{
    use WithPagination, WithoutUrlPagination;
    #[Session]
    public string $FILTER_NAME = '';
    #[Session]
    public string $FILTER_LASTNAME = '';
    #[Session]
    public string $FILTER_EMAIL = '';
    #[Session]
    public ?int $FILTER_COURSE = 0;
    #[Session]
    public string $FILTER_ROLE = '';

    public array $filters = [
        'name' => '',
        'lastname' => '',
        'email' => '',
        'course_id' => 0,
        'role' => '',
    ];

    public function render()
    {
        return view('admin.user-management', [
            'users' => $this->users()->paginate(10),
            'courses' => \App\Models\Course::all(),
        ]);
    }

    public function users(): Builder
    {
        $users = \App\Models\User::join('courses' , 'users.course_id' , '=' , 'courses.id')->selectRaw('users.*, courses.name as course_name')->orderBy('id', 'desc');

        if ($this->FILTER_NAME) {
            $users->where('users.name', 'like', '%' . $this->FILTER_NAME . '%');
        }

        if ($this->FILTER_LASTNAME) {
            $users->where('users.lastname', 'like', '%' . $this->FILTER_LASTNAME . '%');
        }

        if ($this->FILTER_COURSE) {
            $users->where('courses.id', '=',  $this->FILTER_COURSE);
        }

        if ($this->FILTER_EMAIL) {
            $users->where('users.email', 'like', '%' . $this->FILTER_EMAIL . '%');
        }

        if ($this->FILTER_ROLE) {
            $users->where('users.role', 'like', '%' . $this->FILTER_ROLE . '%');
        }

        return $users;
    }

    public function resetFilter()
    {
        $this->FILTER_NAME = '';
        $this->FILTER_COURSE = 0;
        $this->FILTER_LASTNAME = '';
        $this->FILTER_EMAIL = '';
        $this->FILTER_ROLE = '';
    }

    public function download()
    {
        $date = date('Y-m-d-H-i-s');
        $filename = "users-$date.csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return response()->stream(function () {
            $handle = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($handle, [
                'ID',
                'Email',
                'Firstname',
                'Lastname',
                'Phone',
                'Role',
                'Course',
                'Created'
            ]);

            // Fetch and process data in chunks
            $this->users()->chunk(25, function ($users) use ($handle) {
                foreach ($users as $user) {
                    // Extract data from each employee.
                    $data = [
                        $user->id,
                        $user->email,
                        $user->name,
                        $user->lastname,
                        $user->phone,
                        $user->role,
                        $user->course_name,
                        $user->created_at,
                    ];

                    // Write data to a CSV file.
                    fputcsv($handle, $data);
                }
            });

            // Close CSV file handle
            fclose($handle);
        }, 200, $headers);
    }

    public function deleteUser($id)
    {
        \App\Models\User::destroy($id);

        $this->dispatch('$refresh');
        $this->dispatch('user-deleted');
    }
}
