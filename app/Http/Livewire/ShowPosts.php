<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class ShowPosts extends Component
{

    public $search;

    public function render()
    {
        //Los porcentajes sirven para hacer busquedas por cada palabra en la base datos
        $posts = Post::where('title', 'like', '%' . $this->search . '%')->get();

        return view('livewire.show-posts',[
            'posts' => $posts
        ]);
    }
}
