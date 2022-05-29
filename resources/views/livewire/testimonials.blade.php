<div class="p-6">
    <div class="flex items-center justify-end text-right">
        <x-jet-button wire:click="createShowModal">
            {{ __('Create') }}
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
                                <th scope="col" class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Author</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Testimonial</th>
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
                                            {{$item->author}}
                                        </td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">{!! \Illuminate\Support\Str::limit($item->testimonial, 50, '...') !!}</td>
                                        <td class="px-6 py-4 text-right text-sm whitespace-no-wrap">
                                            <x-jet-secondary-button wire:click="updateShowModal({{$item->id}})">
                                                {{ __('Edit') }}
                                            </x-jet-secondary-button>
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
        <x-jet-dialog-modal wire:submit.prevent="save" wire:model="modalFormVisible">
            <x-slot name="title">
                @if ($modelId)
                    {{ __('Update Testimonial') }}
                @else
                {{ __('Create New Testimonial') }}
                @endif
            </x-slot>

            <x-slot name="content">

                <div class="mt-4">
                    <x-jet-label for="author" value="{{ __('Testimonial Author') }}" />
                    <x-jet-input id="author" type="text" class="mt-1 block w-full" wire:model.debounce.100ms="author" autofocus />
                    <x-jet-input-error for="author" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="testimonial" value="{{ __('Testimonial') }}" />
                    
                    <div class="rounded-md shadow-sm">
                        <div class="mt-1 bg-white">
                            <div class="body-content" wire:ignore>
                                <trix-editor
                                    class="trix-content"
                                    x-ref="trix"
                                    wire:model.debounce.100000ms="testimonial"
                                    wire:key="trix-content-unique-key"
                                ></trix-editor>
                            </div>
                        </div>
                    </div>
                    <x-jet-input-error for="testimonial" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                @if ($modelId)
                    <x-jet-button class="ml-3" wire:click="update" wire:loading.attr="disabled">
                        {{ __('Update Testimonial') }}
                    </x-jet-button>
                @else
                    <x-jet-button class="ml-3" wire:click="create" wire:loading.attr="disabled">
                        {{ __('Create Testimonial') }}
                    </x-jet-button>
                @endif
            </x-slot>
        </x-jet-dialog-modal>

        <!-- Delete testimonial modal -->
        <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
            <x-slot name="title">
                {{ __('Delete Testimonial') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete this Testimonial? Once this is deleted, all of its resources and data will be permanently deleted.') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                    {{ __('Delete Testimonial') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
</div>