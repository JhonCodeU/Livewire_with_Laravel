<div>
    <x-jet-danger-button wire:click="$set('open', true)">
        Create new post
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            Create new Post
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                <x-jet-label value="Title of post"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="title"/>
            </div>

            <div class="mb-4">
                <x-jet-label value="Content of post"/>
                <textarea class="form-control w-full" rows="6" wire:model.defer="content"></textarea>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancel
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save">
                Create Post
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>
</div>
