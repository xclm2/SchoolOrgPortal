<?php
namespace App\Livewire\Post;

use App\Models\Organization\Post;
use Livewire\Component;

class View extends Component
{
    public Post $post;
    public function mount($id)
    {
        $this->post = Post::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.post.view', ['post' => $this->post]);
    }
}
