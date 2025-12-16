<x-app-layout>

    <main class="w-4/5 p-6 bg-slate-50 min-h-screen w-full">
        <h1 class="text-2xl font-bold mb-4">Users</h1>
        <div class="mb-4">
            <label for="createUserModal"
               class="px-3 py-1 bg-sky-600 text-white text-sm rounded hover:bg-sky-700 float-right">
               +Add User
            </label>
            <x-modal.createUserModal></x-modal.createUserModal>
        </div>

        <table class="min-w-full bg-white rounded-lg">
            <thead>
                <tr class="bg-sky-50">
                    <th class="py-1 px-3 border-b text-sm">ID</th>
                    <th class="py-1 px-3 border-b text-sm">name</th>
                    <th class="py-1 px-3 border-b text-sm">Email</th>
                    <th class="py-1 px-3 border-b text-sm">Created At</th>
                    <th class="py-1 px-3 border-b text-sm text-right">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="py-1 px-3 border-b text-sm text-center">{{ $user->id }}</td>
                    <td class="py-1 px-3 border-b text-sm text-center">{{ $user->name }}</td>
                    <td class="py-1 px-3 border-b text-sm text-center">{{ $user->email }}</td>
                    <td class="py-1 px-3 border-b text-xs text-center">{{ $user->created_at->format('M d, Y') }}</td>
                    <td class="py-1 px-3 border-b">
                        <div class="flex justify-end space-x-2">
                            <label for="editUserModal-{{ $user->id }}"
                               class="px-2 py-1 text-sm text-blue-500 rounded hover:underline">
                               Edit
                            </label>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you very sure you want to delete this user?')" class="px-2 py-1 text-sm text-red-500 rounded hover:underline">
                                    Delete
                                </button>
                            </form>
                            <x-modal.editUserModal :user="$user"></x-modal.editUserModal>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </main>

</x-app-layout>

