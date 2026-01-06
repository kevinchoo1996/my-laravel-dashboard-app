<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Product
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="max-w-7xl mx-auto">
                <form method="POST" action="{{ route('inventory.products.update', $product) }}">
                    @csrf
                    @method('PUT')

                    <div class="bg-white shadow-sm rounded-lg p-6">

                        {{-- Validation errors --}}
                        @if ($errors->any())
                            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                                <ul class="list-disc pl-5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Product Name --}}
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-medium mb-1">
                                Product Name
                            </label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300"
                                value="{{ old('name', $product->name) }}"
                                required
                            >
                        </div>

                        {{-- Category --}}
                        <div class="mb-4">
                            <label for="category_id" class="block text-gray-700 font-medium mb-1">
                                Category
                            </label>
                            <select
                                name="category_id"
                                id="category_id"
                                class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300"
                            >
                                <option value="">-- Select Category --</option>
                                @foreach ($categories as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        @selected(old('category_id', $product->category_id) == $category->id)
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Price --}}
                        <div class="mb-4">
                            <label for="price" class="block text-gray-700 font-medium mb-1">
                                Price
                            </label>
                            <input
                                type="number"
                                name="price"
                                id="price"
                                step="0.01"
                                min="0"
                                class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300"
                                value="{{ old('price', $product->price) }}"
                                required
                            >
                        </div>

                        {{-- Stock --}}
                        <div class="mb-4">
                            <label for="stock" class="block text-gray-700 font-medium mb-1">
                                Stock
                            </label>
                            <input
                                type="number"
                                name="stock"
                                id="stock"
                                min="0"
                                class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300"
                                value="{{ old('stock', $product->stock) }}"
                                required
                            >
                        </div>

                        {{-- Enabled --}}
                        <div class="mb-4 flex items-center">
                            <input type="hidden" name="enabled" value="0">
                            <input
                                type="checkbox"
                                name="enabled"
                                id="enabled"
                                value="1"
                                class="h-4 w-4 text-blue-600 border-gray-300 rounded"
                                @checked(old('enabled', $product->enabled))
                            >
                            <label for="enabled" class="ml-2 text-gray-700 font-medium">
                                Enabled
                            </label>
                        </div>

                    </div>

                    {{-- Actions --}}
                    <div class="flex justify-end space-x-2 mt-4">
                        <button
                            type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                        >
                            Update
                        </button>

                        <a
                            href="{{ route('inventory.products.index') }}"
                            class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400"
                        >
                            Cancel
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
