<?php
namespace App\Livewire\Member\Events\View;

use App\Livewire\Member\AbstractMember;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Session;
use Livewire\WithPagination;

class ListView extends AbstractMember
{
    use WithPagination;
    public Organization $organization;
    #[Session]
    public string $show = 'all';

    public function mount(Organization $organization)
    {
        $this->organization = $organization;
    }

    public function render()
    {
        return view('member.events.view.list', [
            'posts' => $this->getPosts()->paginate(10),
            'new_posts' => $this->_getNewPosts(),
            'is_adviser' => $this->getCurrentUser()->role == User::ROLE_ADVISER
        ]);
    }

    public function getPosts()
    {
        switch ($this->show) {
            case 'active':
                break;
            case 'completed':
                return $this->organization->getPosts()
                    ->whereRaw('((end_date IS NULL AND start_date < NOW()) OR (end_date IS NOT NULL and end_date < NOW()))');
        }

        return $this->organization->getPosts();
    }

    public function setFilter($filter)
    {
        $this->show = $filter;
        $this->dispatch('$refresh');
    }

    protected function _getNewPosts()
    {
        if (! Auth::check()) {
            return [];
        }

        if (! $this->getCurrentUser()->getMember()) {
            return [];
        }
        $notifications = $this->getCurrentUser()->getMember()->unreadNotifications->where('read_at', null);

        $newPosts = [];
        foreach ($notifications as $notification) {
            if (! isset($notification->data['post_id'])) {
                continue;
            }

            $newPosts[] = $notification->data['post_id'];
        }

        $notifications->markAsRead();
        return $newPosts;
    }

    public function trimString($string, $limit = 800)
    {
        // Strip tags and decode HTML entities to handle entities properly
        $strippedString = strip_tags(html_entity_decode($string));

        // Check if string length exceeds the limit
        if (strlen($strippedString) > $limit) {
            // Truncate the string and append ellipsis
            $truncatedString = substr($strippedString, 0, $limit) . '...';
        } else {
            // No need to truncate, return the original string
            $truncatedString = $strippedString;
        }

        // Re-encode the string as HTML
        return htmlentities($truncatedString, ENT_QUOTES, 'UTF-8');
    }

    public function download()
    {
        $orgname = str_replace(' ', '_', $this->organization->name);
        $filename = "organization-$orgname-$this->show-events.csv";
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
                'Title',
                'Start Date',
                'End Date',
                'Posted',
            ]);

            // Fetch and process data in chunks
            $this->getPosts()->chunk(25, function ($posts) use ($handle) {
                foreach ($posts as $post) {
                    $endDate = $post->end_date != null ? $post->end_date : $post->start_date;
                    // Extract data from each employee.
                    $data = [
                        $post->id,
                        $post->title,
                        date('Y-m-d', strtotime($post->start_date)),
                        date('Y-m-d', strtotime($endDate)),
                        $post->created_at
                    ];

                    // Write data to a CSV file.
                    fputcsv($handle, $data);
                }
            });

            // Close CSV file handle
            fclose($handle);
        }, 200, $headers);
    }
}
