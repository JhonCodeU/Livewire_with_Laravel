<div>
    <a class="btn btn-green" wire:click="$set('open', true)">
        <i class="fas fa-edit"></i>
    </a>

    <x-jet-dialog-modal wire:model="open">

        <x-slot name='title'>
            {{$post->title}}
        </x-slot>

        <x-slot name='content'>

            <div wire:loading wire:target="image" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Imagen loading!</strong>
                <span class="block sm:inline">Wait a moment to imagen is in process.</span>
            </div>

            @if ($image)
                <img class="mb-4" src="{{$image->temporaryUrl()}}">
            @else
                <img class="mb-4" src="{{Storage::url($post->image)}}">
            @endif

            <div>
                <x-jet-label value="Title of the post"/>
                <x-jet-input wire:model="post.title" type="text" class="w-full" />
            </div>

            <div>
                <x-jet-label value="Content of the post"/>
                <textarea rows="6" wire:model="post.content" class="form-control w-full"></textarea>
            </div>

            <div>
                <input type="file" wire:model="image" id="{{$identificator}}">
                <x-jet-input-error for="image"/>
            </div>
        </x-slot>

        <x-slot name='footer'>
            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancel
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" class="disabled:opacity-25">
                Update
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>
</div> 
