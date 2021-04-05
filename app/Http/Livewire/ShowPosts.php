<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class ShowPosts extends Component
{

    public $search;
    public $sort = 'id';
    public $direction = 'desc';

    protected $listeners = ['render'];

    public function render()
    {
        //Los porcentajes sirven para hacer busquedas por cada palabra en la base datos
        $posts = Post::where('title', 'like', '%' . $this->search . '%')
        ->orWhere('content', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->get();

        return view('livewire.show-posts',[
            'posts' => $posts
        ]);
    }

    public function order($sort = ''){
        $this->sort = $sort;
        
        if ($sort) {
            if ($this->sort == $sort) {
                $this->direction = $this->direction == 'desc' ? 'asc' : 'desc';
            }else{
                $this->direction == 'asc';
            }
        }        
    }
}
