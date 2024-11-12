<?php
namespace App\Livewire\Post;

use App\Models\Organization\Comment;
use App\Models\Organization\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class View extends Component
{
    public Post $post;
    #[Validate('max:500')]
    public string $comment ='sdfs';

    public function mount($id)
    {
        $this->post = Post::findOrFail($id);
    }

    public function render()
    {
        $memberId = 0;
        if (Auth::check()) {
            $user = User::findOrFail(Auth::user()->id);
            $memberId = $user->getMember()?->id ?? 0;
        }

        return view('livewire.post.view', [
            'post' => $this->post,
            'broadcast_on' => 'comment-' . $this->post->id,
            'post_id' => $this->post->id,
            'member_id' => $memberId
        ]);
    }

    public function sendComment()
    {
        $this->dispatch('updateComments');
    }
}
