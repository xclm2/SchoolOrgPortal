<?php
namespace App\Livewire\Member\Events\View;

use App\Livewire\Member\AbstractMember;
use App\Models\Organization;
use Livewire\WithPagination;

class ListView extends AbstractMember
{
    use WithPagination;
    public Organization $organization;

    public function mount(Organization $organization)
    {
        $this->organization = $organization;
    }

    public function render()
    {
        return view('member.events.view.list', ['posts' => $this->organization->getPosts()->paginate(10)]);
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
}
