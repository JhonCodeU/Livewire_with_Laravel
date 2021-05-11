<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowPosts extends Component
{

    use WithFileUploads;
    use WithPagination;

    public $post, $image, $identificator;
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $amount = '10'; 

    public $open_edit = false;

    //Url Modify
    protected $queryString = [
        'amount' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    public $rules = [
        'post.title' => 'required',
        'post.content' => 'required',
    ];

    public function mount(){
        $this->identificator = rand();
        $this->post = new Post();
    }

    protected $listeners = ['render'];

    public function render()
    {
        //Los porcentajes sirven para hacer busquedas por cada palabra en la base datos
        $posts = Post::where('title', 'like', '%' . $this->search . '%')
        ->orWhere('content', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->paginate($this->amount);

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

    public function edit(Post $post){
        $this->post = $post;
        $this->open_edit = true;
    }

    public function update(){
        $this->validate();

        if ($this->image) {
            Storage::delete([$this->post->image]);
            $this->post->image = $this->image->store('posts');
        }

        $this->post->update();

        $this->reset(['open_edit', 'image']);
        $this->identificator = rand();

        $this->emit('alert', 'The post was updated successfully');
    }

    public function updatingSearch(){
        $this->resetPage();
    }
}
