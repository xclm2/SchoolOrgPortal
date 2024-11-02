<?php
namespace App\Livewire\Member\Events;


use App\Livewire\Member\AbstractMember;
use App\Models\Organization\Comment;
use App\Models\Organization\Post;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;

class Comments extends AbstractMember
{
    use WithPagination;
    public Post $post;
    public int $page = 1;
    public int $limit =10;

//    protected $listeners = ['updateComments' => '$refresh'];
    public bool $isFirstLoad = true;
    public $lastComment;
    public $comments;
    public $totalComments = 0;

    public function mount($post)
    {
        if (! $post instanceof Post) {
            return redirect('/');
        }

        $this->post = $post;
    }

    public function render()
    {
        if ($this->lastComment == null) {
            $this->lastComment = $this->post->getComments()->latest()->first()?->id ?? 0;
        }

        $this->totalComments = $this->post->getComments()->count();

        $arr = [];
        $comments = $this->post->getComments()
            ->join('organization_member', 'organization_member.id' , '=' ,'organization_post_comment.member_id')
            ->join('users', 'users.id' , '=' ,'organization_member.user_id')
            ->select('organization_post_comment.*', 'users.name', 'users.lastname')
            ->orderByDesc('organization_post_comment.created_at')->where('organization_post_comment.id', '<=', $this->lastComment)
            ->limit($this->limit)->get();

        foreach ($comments as $comment) {
            $arr[] = $comment;
        }

        krsort($arr);
        $this->comments = $arr;
        return view('member.events.comments');
    }

    public function loadMore()
    {
        $this->limit+=5;
    }
}
