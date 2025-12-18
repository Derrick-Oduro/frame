<x-app-layout>
    @can('view categories')
    <main class="w-4/5 p-6 bg-slate-50 min-h-screen w-full">
        <h1 class="text-2xl font-bold mb-4">Category</h1>
        <div class="mb-4">
            @can('create categories')
            <label for="createCategoryModal"
               class="px-3 py-1 bg-sky-600 text-white text-sm rounded hover:bg-sky-700 float-right">
               +Add category
            </label>
            @endcan
            <x-modal.createCategoryModal></x-modal.createCategoryModal>
        </div>

        <table class="min-w-full bg-white rounded-lg">
            <thead>
                <tr class="bg-sky-50">
                    <th class="py-1 px-3 border-b text-sm">ID</th>
                    <th class="py-1 px-3 border-b text-sm">name</th>
                    <th class="py-1 px-3 border-b text-sm">slug</th>
                    <th class="py-1 px-3 border-b text-sm">Created At</th>
                    <th class="py-1 px-3 border-b text-sm text-right">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td class="py-1 px-3 border-b text-sm text-center">{{ $category->id }}</td>
                    <td class="py-1 px-3 border-b text-sm text-center">{{ $category->name }}</td>
                    <td class="py-1 px-3 border-b text-sm text-center">{{ $category->slug }}</td>
                    <td class="py-1 px-3 border-b text-xs text-center">{{ $category->created_at->format('M d, Y') }}</td>
                    <td class="py-1 px-3 border-b">
                        <div class="flex justify-end space-x-2">
                            @can('edit categories')
                            <label for="editCategoryModal-{{ $category->id }}"
                               class="px-2 py-1 text-sm text-blue-500 rounded hover:underline">
                               Edit
                            </label>
                            @endcan
                            @can('delete categories')
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you very sure you want to delete this category?')" class="px-2 py-1 text-sm text-red-500 rounded hover:underline">
                                    Delete
                                </button>
                            </form>
                            @endcan
                            <x-modal.editCategoryModal :category="$category"></x-modal.editCategoryModal>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>
    @else
        <div class="w-4/5 p-6 bg-slate-50 min-h-screen w-full flex items-center justify-center">
            <h2 class="text-2xl font-bold text-red-600">You do not have permission to view this page.</h2>
        </div>
    @endcan
</x-app-layout>
