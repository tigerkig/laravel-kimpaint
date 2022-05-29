

<div class="p-6">
    <div class="flex items-center justify-end text-right">
        <x-jet-button wire:click="createShowModal">
            {{ __('Upload') }}
        </x-jet-button>
    </div>

    <!-- Data table -->
    <div class="flex flex-col py-3">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block w-full lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Created at</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Photo</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th scope="col" class="relative px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($data->count())
                                @foreach ($data as $item)
                                    <tr>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                            {{ date('F d, Y', strtotime($item->created_at)) }}
                                        </td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                            <img src="/storage/{{$item->fileName}}" alt="{{ $item->fileTitle }}"/>
                                        </td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                            &lt;img src="/storage/{{ $item->fileName}}" alt="{{ $item->fileTitle }}" /&gt;
                                        </td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                            {{$item->fileTitle}}
                                        </td>
                                        <td class="px-6 py-4 text-right text-sm whitespace-no-wrap">
                                            <x-jet-danger-button wire:click="deleteShowModal({{$item->id}})">
                                                {{ __('Delete') }}
                                            </x-jet-danger-button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="px-6 py-4 text-sm whitespace-no-wrap" colspan="4">No results found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{ $data->links() }}

    <!-- Modal Form -->
    <x-jet-dialog-modal wire:submit.prevent="submit" enctype="multipart/form-data" wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('Upload New Photo') }}
        </x-slot>

        <x-slot name="content">

            <div class="mt-4">
                <x-jet-label for="fileTitle" value="{{ __('Photo Name') }}" />
                <x-jet-input id="fileTitle" type="text" class="mt-1 block w-full" wire:model.debounce.100ms="fileTitle" autofocus />
                <x-jet-input-error for="fileTitle" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-jet-label for="fileName" value="{{ __('Photo Name') }}" />
                <x-jet-input id="fileName" type="file" class="mt-1 block w-full" wire:model="fileName" autofocus />
                <x-jet-input-error for="fileName" class="mt-2" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-3" wire:click="submit" wire:loading.attr="disabled">
                {{ __('Upload Photo') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Delete page modal -->
    <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
        <x-slot name="title">
            {{ __('Delete Photo') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this photo? Once this photo is deleted, all of its resources and data will be permanently deleted.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete Photo') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
