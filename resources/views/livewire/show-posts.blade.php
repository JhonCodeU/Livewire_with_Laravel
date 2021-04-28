<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <x-table>

            {{--$search--}}
            
            <div class="px-6 py-4 flex items-center">
                <!--<input type="text" wire:model="search" placeholder="Search a register">-->
                <x-jet-input class="flex-1 mr-4" type="text" wire:model="search" placeholder="Search a register"/>

                @livewire('create-post')
            </div>

            @if ($posts->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    wire:click="order('id')">
                    ID

                    @if ($sort == 'id')
                    
                        @if ($direction == 'asc')
                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                        @else
                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                        @endif

                    @else
                        <i class="fas fa-sort float-right mt-1"></i>
                    @endif
                    </th>
                    <th scope="col" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    wire:click="order('title')">
                    Title

                    @if ($sort == 'title')
                    
                       @if ($direction == 'asc')
                           <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                       @else
                           <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                       @endif

                    @else
                        <i class="fas fa-sort float-right mt-1"></i>
                    @endif
                    </th>
                    <th scope="col" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    wire:click="order('content')">
                    Content

                    @if ($sort == 'content')
                    
                        @if ($direction == 'asc')
                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                        @else
                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                        @endif

                    @else
                        <i class="fas fa-sort float-right mt-1"></i>
                    @endif
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($posts as $item)
                <tr>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{$item->id}}</div>
                    </td>
                    <td class="px-6 py-4">
                    <div class="text-sm text-gray-900">{{$item->title}}</div>
                    <div class="text-sm text-gray-500">Optimization</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{$item->content}}</div>
                    </td>   
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        {{-- @livewire('edit-post', ['post' => $post], key($post->id)) --}}
                        <a class="btn btn-green" wire:click="edit({{$item}})">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
                <!-- More items-->
                </tbody>
            </table>
            @else
                <div class="px-6 py-4">
                    There is no records
                </div>
            @endif
        </x-table>
    </div>

    <x-jet-dialog-modal wire:model="open_edit">

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
            <x-jet-secondary-button wire:click="$set('open_edit', false)">
                Cancel
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" class="disabled:opacity-25">
                Update
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>
</div>
