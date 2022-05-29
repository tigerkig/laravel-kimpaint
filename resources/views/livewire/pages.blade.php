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
                                <th scope="col" class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Link</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Content</th>
                                <th scope="col" class="relative px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($data->count())
                                @foreach ($data as $item)
                                    <tr>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                            {{$item->title}}
                                            {!! $item->is_default_home ? '<span class="text-green-400 text-xs font-bold">[Default Home Page]</span>' : '' !!}
                                            {!! $item->is_default_not_found ? '<span class="text-red-600 text-xs font-bold">[Default 404 Error Page]</span>' : '' !!}
                                        </td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                            <a 
                                                class="text-indigo-600 hover:text-indigo-900"
                                                target="_blank"
                                                href="{{ URL::to('/'.$item->slug)}}"
                                            >
                                                {{$item->slug}}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">{!! \Illuminate\Support\Str::limit($item->content, 50, '...') !!}</td>
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
        <x-jet-dialog-modal wire:model="modalFormVisible">
            <x-slot name="title">
                @if ($modelId)
                    {{ __('Update Page') }}
                @else
                {{ __('Create New Page') }}
                @endif
            </x-slot>

            <x-slot name="content">
                <div class="mt-4">
                    <x-jet-label for="title" value="{{ __('Page Title') }}" />
                    <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model.debounce.100ms="title" autofocus />
                    <!-- @error('title') <span class="error">{{ $message }}</span> @enderror -->
                    <x-jet-input-error for="title" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="slug" class="block text-sm font-medium text-gray-700" value="{{ __('Slug') }}"/>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                            http://localhost:8000/
                        </span>
                        <input type="text" name="slug" id="slug" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" wire:model.debounce.100ms="slug" placeholder="url-slug">
                    </div>
                    <!-- @error('slug') <span class="error">{{ $message }}</span> @enderror -->
                    <x-jet-input-error for="slug" class="mt-2" />
                </div>

                <div class="mt-4">
                    <label for="isSetToDefaultHomePage">
                        <input class="form-checkbox" type="checkbox" name="isSetToDefaultHomePage" value="{{ $isSetToDefaultHomePage }}" wire:model="isSetToDefaultHomePage"/>
                        <span class="ml-2 text-sm font-medium text-gray-700">Set as default home page</span>
                    </label>
                    <x-jet-input-error for="isSetToDefaultHomePage" class="mt-2" />
                </div>

                <div class="mt-4">
                    <label for="isSetToDefaultNotFoundPage">
                        <input class="form-checkbox" type="checkbox" name="isSetToDefaultNotFoundPage" value="{{ $isSetToDefaultNotFoundPage }}" wire:model="isSetToDefaultNotFoundPage"/>
                        <span class="ml-2 text-sm font-medium text-gray-700">Set as default 404 error page</span>
                    </label>
                    <x-jet-input-error for="isSetToDefaultNotFoundPage" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="content" value="{{ __('Content') }}" />
                    
                    <div class="rounded-md shadow-sm">
                        <div class="mt-1 bg-white">
                            <div class="body-content" wire:ignore>
                                <trix-editor
                                    class="trix-content"
                                    x-ref="trix"
                                    wire:model.debounce.100000ms="content"
                                    wire:key="trix-content-unique-key"
                                ></trix-editor>
                            </div>
                        </div>
                    </div>
                    <!-- @error('content') <span class="error">{{ $message }}</span> @enderror -->
                    <x-jet-input-error for="content" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                @if ($modelId)
                    <x-jet-button class="ml-3" wire:click="update" wire:loading.attr="disabled">
                        {{ __('Update Page') }}
                    </x-jet-button>
                @else
                    <x-jet-button class="ml-3" wire:click="create" wire:loading.attr="disabled">
                        {{ __('Create Page') }}
                    </x-jet-button>
                @endif
            </x-slot>
        </x-jet-dialog-modal>

        <!-- Delete page modal -->
        <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
            <x-slot name="title">
                {{ __('Delete Page') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete this page? Once this page is deleted, all of its resources and data will be permanently deleted.') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                    {{ __('Delete Page') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
</div>
