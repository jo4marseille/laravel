<form wire:submit.prevent="submit" method="POST">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="grid grid-cols-4">
                <div class="col-start-2 col-span-2 p-6">
                    <form wire:submit.prevent="submit" method="POST">

                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                                    <input type="text" wire:model.defer="name" id="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('name') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                @if ($old_image)
                                    <div class="space-y-1 text-center">
                                        <div class="flex text-sm text-gray-600">
                                            <img src="{{ $old_image }}" class="h-64">
                                        </div>
                                    </div>
                                @endif

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                                    <input type="file" wire:model="image">

                                    @error('image') <span class="error">{{ $message }}</span> @enderror
                                </div>                

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="link" class="block text-sm font-medium text-gray-700">Lien</label>
                                    <input type="text" wire:model.defer="link" id="link" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('link') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea wire:model.defer="description" id="description" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                                    @error('description') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="video" class="block text-sm font-medium text-gray-700">Lien Video</label>
                                    <input type="text" wire:model.defer="video" id="video" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('video') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="mt-5">
                                    <label for="status" class="inline-flex items-center">Statut</label>
                                    <input type="checkbox" wire:model.defer="status" id="status" 
                                    @if ($status) checked @endif class="form-checkbox mr-1 rounded h-6 w-6 text-blue-500" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="git_depo" class="block text-sm font-medium text-gray-700">Git Repo</label>
                                    <input type="text" wire:model.defer="git_depo" id="git_depo" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('git_depo') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="desc_techno" class="block text-sm font-medium text-gray-700">Description Techno</label>
                                    <input type="text" wire:model.defer="desc_techno" id="desc_techno" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('desc_techno') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="app_link_android" class="block text-sm font-medium text-gray-700">Lien App Android</label>
                                    <input type="text" wire:model.defer="app_link_android" id="app_link_android" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('app_link_android') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="app_link_ios" class="block text-sm font-medium text-gray-700">Lien App iOS</label>
                                    <input type="text" wire:model.defer="app_link_ios" id="app_link_ios" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('app_link_ios') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                {{-- asso id select --}}
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="asso" class="block text-sm font-medium text-gray-700">Association</label>
                                    <select class="form-control" style="width: 100%" wire:model.defer="asso" id="asso">
                                        <option value="">Choisissez une association</option>
                                        @foreach ($assos as $asso)
                                            <option value="{{ $asso->id }}">
                                                {{ $asso->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Submit
                                </button>
                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>

    </div>
    </form>
