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
                                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
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

                                @if ($old_logo)
                                    <div class="space-y-1 text-center">
                                        <div class="flex text-sm text-gray-600">
                                            <img src="{{ $old_logo }}" class="h-64">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="logo" class="block text-sm font-medium text-gray-700">Logo</label>
                                    <input type="file" wire:model="logo">

                                    @error('logo') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea wire:model.defer="description" id="description" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                                    @error('description') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="link" class="block text-sm font-medium text-gray-700">Lien officiel de l'association</label>
                                    <input type="text" wire:model.defer="link" id="link" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('link') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="indicator_value_1" class="block text-sm font-medium text-gray-700">Valeur du 1e indicateur</label>
                                    <input type="number" wire:model.defer="indicator_value_1" id="indicator_value_1" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('indicator_value_1') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="indicator_unit_1" class="block text-sm font-medium text-gray-700">Unité du 1e indicateur</label>
                                    <input type="text" maxlength="5" wire:model.defer="indicator_unit_1" id="indicator_unit_1" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('indicator_unit_1') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="indicator_label_1" class="block text-sm font-medium text-gray-700">Libellé du 1e indicateur</label>
                                    <input type="text" wire:model.defer="indicator_label_1" id="indicator_label_1" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('indicator_label_1') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="indicator_value_2" class="block text-sm font-medium text-gray-700">Valeur du 2e indicateur</label>
                                    <input type="number" wire:model.defer="indicator_value_2" id="indicator_value_2" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('indicator_value_2') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="indicator_unit_2" class="block text-sm font-medium text-gray-700">Unité du 2e indicateur</label>
                                    <input type="text" maxlength="5" wire:model.defer="indicator_unit_2" id="indicator_unit_2" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('indicator_unit_2') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="indicator_label_2" class="block text-sm font-medium text-gray-700">Libellé du 2e indicateur</label>
                                    <input type="text" wire:model.defer="indicator_label_2" id="indicator_label_2" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('indicator_label_2') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="indicator_value_3" class="block text-sm font-medium text-gray-700">Valeur du 3e indicateur</label>
                                    <input type="number" wire:model.defer="indicator_value_3" id="indicator_value_3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('indicator_value_3') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="indicator_unit_3" class="block text-sm font-medium text-gray-700">Unité du 3e indicateur</label>
                                    <input type="text" maxlength="5" wire:model.defer="indicator_unit_3" id="indicator_unit_3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('indicator_unit_3') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="indicator_label_3" class="block text-sm font-medium text-gray-700">Libellé du 3e indicateur</label>
                                    <input type="text" wire:model.defer="indicator_label_3" id="indicator_label_3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('indicator_label_3') <span class="error">{{ $message }}</span> @enderror
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
