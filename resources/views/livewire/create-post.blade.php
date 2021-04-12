<div>
    <x-jet-danger-button wire:click="$set('open', true)">
        Create new post
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            Create new Post
        </x-slot>

        <x-slot name="content">

            <div wire:loading wire:target="image" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Imagen loading!</strong>
                <span class="block sm:inline">Wait a moment to imagen is in process.</span>
            </div>

            @if ($image)
                <img class="mb-4" src="{{$image->temporaryUrl()}}">
            @endif

            <div class="mb-4">
                <x-jet-label value="Title of post"/>
                <x-jet-input type="text" class="w-full" wire:model="title"/>
            </div>

            <x-jet-input-error for="title"/>

            <div class="mb-4">
                <x-jet-label value="Content of post"/>
                <textarea class="form-control w-full" rows="6" wire:model="content"></textarea>
                <x-jet-input-error for="content"/>
            </div>

            <div>
                <input type="file" wire:model="image" id="{{$identificator}}">
                <x-jet-input-error for="image"/>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancel
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save, image" class="disabled:opacity-25">
                Create Post
            </x-jet-danger-button>

        </x-slot>

    </x-jet-dialog-modal>
</div>
