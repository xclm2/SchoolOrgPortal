<?php
namespace App\Livewire\Post;
use App\Models\Organization\Post;
use Livewire\Component;

class Item extends Component
{
    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('post.item', ['post' => $this->post]);
    }
}
