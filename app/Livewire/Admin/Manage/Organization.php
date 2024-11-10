<?php
namespace App\Livewire\Admin\Manage;

use App\Livewire\Admin\AbstractComponent;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Organization extends AbstractComponent
{
    use WithPagination, WithoutUrlPagination;

    public function render()
    {

        return view('admin.org-management', [
            'organizations' => $this->_getOrganizations()->paginate(10),
            'new_organizations' => $this->_getNewOrganizations(),
        ]);
    }

    protected function _getOrganizations()
    {
        return \App\Models\Organization::leftJoin('courses' , 'organization.course_id' , '=' , 'courses.id')
            ->selectRaw('organization.*, courses.name as course_name')
            ->orderBy('id', 'desc');
    }

    public function download()
    {
        $filename = "organizations.csv";
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
                'Name',
                'Description',
                'Course',
                'Status',
                'Date Created',
            ]);

            // Fetch and process data in chunks
            $this->_getOrganizations()->chunk(25, function ($organizations) use ($handle) {
                foreach ($organizations as $organization) {
                    // Extract data from each employee.
                    $data = [
                        $organization->id,
                        $organization->name,
                        $organization->description,
                        $organization->course_name,
                        $organization->status,
                        $organization->created_at,
                    ];

                    // Write data to a CSV file.
                    fputcsv($handle, $data);
                }
            });

            // Close CSV file handle
            fclose($handle);
        }, 200, $headers);
    }

    protected function _getNewOrganizations()
    {
        $organizationIds = [];
        $notifications = auth()->user()->unreadNotifications;
        foreach ($notifications as $notification) {
            $organizationIds[] = $notification->data['organization_id'];
        }

        $notifications->markAsRead();
        return $organizationIds;
    }

    public function deleteOrg($id)
    {
        \App\Models\Organization::destroy($id);
        $this->dispatch('organization-deleted');
    }
}
