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
        $user = User::find(Auth::user()->id);
        return view('livewire.post.view', [
            'post' => $this->post,
            'broadcast_on' => 'comment-' . $this->post->id,
            'post_id' => $this->post->id,
            'member_id' => $user->getMember()->id
        ]);
    }

    public function sendComment()
    {
        $this->dispatch('updateComments');
    }
}
