<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Products
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Header + Filters + More Actions --}}
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-4 space-y-2 sm:space-y-0">

                {{-- Filter Form --}}
                <form method="GET" action="{{ route('inventory.products.index') }}" class="flex items-center space-x-2">
                    <div>
                        <label for="category_id" class="sr-only">Category</label>
                        <select id="category_id" name="category_id"
                            class="block w-full rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-base focus:border-blue-500 focus:ring-1 focus:ring-blue-500 sm:text-sm appearance-none">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="enabled" class="sr-only">Status</label>
                        <select id="enabled" name="enabled"
                            class="block w-full rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-base focus:border-blue-500 focus:ring-1 focus:ring-blue-500 sm:text-sm appearance-none">
                            <option value="">All Status</option>
                            <option value="1" @selected(request('enabled') === '1')>Enabled</option>
                            <option value="0" @selected(request('enabled') === '0')>Disabled</option>
                        </select>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-3 py-2 rounded">Filter</button>
                </form>

                {{-- More Button --}}
                <div class="relative inline-block text-left">
                    <button id="more-button" type="button"
                        class="flex items-center justify-center w-10 h-10 rounded-full border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 shadow-sm"
                        aria-expanded="true" aria-haspopup="true">
                        {{-- Heroicon EllipsisVertical --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v.01M12 12v.01M12 18v.01" />
                        </svg>
                    </button>

                    {{-- Dropdown --}}
                    <div id="more-dropdown"
                        class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                        <div class="py-1">
                            <a href="{{ route('inventory.products.create') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Create Product</a>
                            <button id="bulk-delete-top" type="button"
                                class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                Bulk Delete
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Products Table (Bulk Delete Form) --}}
            <form id="bulk-delete-form" method="POST" action="{{ route('inventory.products.bulk-delete') }}">
                @csrf
                @method('DELETE')

                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <input type="checkbox" id="select-all" class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enabled</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($products as $product)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="checkbox" name="selected[]" value="{{ $product->id }}" class="select-item h-4 w-4 text-blue-600 border-gray-300 rounded">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->category->name ?? '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ number_format($product->price, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->stock }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($product->enabled)
                                                <span class="text-green-600 font-semibold">Yes</span>
                                            @else
                                                <span class="text-red-600 font-semibold">No</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right flex justify-end gap-2">
                                            {{-- Edit --}}
                                            <a href="{{ route('inventory.products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>

                                            {{-- Delete redirect --}}
                                            <a href="{{ url("inventory/products/{$product->id}/delete") }}"
                                                onclick="return confirm('Are you sure you want to delete this product?');"
                                                class="text-red-600 hover:text-red-800 font-medium">Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center">No products found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $products->withQueryString()->links() }}
            </div>

        </div>
    </div>

    <script>
        // Select all checkboxes
        const selectAll = document.getElementById('select-all');
        const items = document.querySelectorAll('.select-item');
        selectAll.addEventListener('change', () => {
            items.forEach(i => i.checked = selectAll.checked);
        });

        // Bulk delete function
        function bulkDelete() {
            const checked = document.querySelectorAll('.select-item:checked');
            if (checked.length === 0) {
                alert('Please select at least one product.');
                return;
            }
            if (confirm('Are you sure you want to delete the selected products?')) {
                document.getElementById('bulk-delete-form').submit();
            }
        }

        // Toggle dropdown
        const moreButton = document.getElementById('more-button');
        const dropdown = document.getElementById('more-dropdown');
        moreButton.addEventListener('click', () => {
            dropdown.classList.toggle('hidden');
        });
        window.addEventListener('click', (e) => {
            if (!moreButton.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // Top bulk delete dropdown button triggers same bulk delete
        const bulkDeleteTop = document.getElementById('bulk-delete-top');
        bulkDeleteTop.addEventListener('click', bulkDelete);
    </script>

    @if (session('success'))
        <div 
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 3000)"
            x-show="show"
            x-transition
            class="fixed top-6 right-6 z-50 max-w-sm w-full bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg flex items-center justify-between"
        >
            <span class="text-sm font-medium">
                {{ session('success') }}
            </span>
            <button @click="show = false" class="ml-4 text-white hover:text-gray-200">
                ✕
            </button>
        </div>
    @endif
</x-app-layout>
