<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditPost extends Component
{
    use WithFileUploads;

    public $open = false;
    public $post, $image, $identificator;

    public $rules = [
        'post.title' => 'required',
        'post.content' => 'required',
    ];

    public function mount(Post $post){
        $this->post = $post;
        $this->identificator = rand();
    }

    public function update()
    {
        $this->validate();

        if ($this->image) {
            Storage::delete([$this->post->image]);
            $this->post->image = $this->image->store('posts');
        }

        $this->post->update();

        $this->reset(['open', 'image']);
        $this->identificator = rand();
        $this->emitTo('show-posts','render');

        $this->emit('alert', 'The post was  updated successfully');
    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}
