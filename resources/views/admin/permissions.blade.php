<x-app-layout>
    @can('manage permissions')
    <main class="w-3/4 p-6 bg-slate-50 min-h-screen w-full">
        <h1 class="text-2xl font-bold text-slate-900 mb-4">Role Management</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white rounded-lg">
            <thead class="bg-slate-100">
                <tr>
                    <th class="py-3 px-4 border-b text-center">ID</th>
                    <th class="py-3 px-4 border-b text-center">Role Name</th>
                    <th class="py-3 px-4 border-b text-center">Guard Name</th>
                    <th class="py-3 px-4 border-b text-center">Permissions Count</th>
                    <th class="py-3 px-4 border-b text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($roles as $role)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-4 border-b text-center">{{ $role->id }}</td>
                    <td class="py-3 px-4 border-b text-center">{{ $role->name }}</td>
                    <td class="py-3 px-4 border-b text-center">{{ $role->guard_name }}</td>
                    <td class="py-3 px-4 border-b text-center">{{ $role->permissions->count() }}</td>
                    <td class="py-3 px-4 border-b text-center">
                        <label for="managePermissionsModal-{{ $role->id }}"
                               class="text-blue-600 hover:text-blue-800 cursor-pointer font-medium">
                            Manage Permissions
                        </label>
                    </td>
                </tr>

                <x-modal.managePermissionsModal :role="$role" :allPermissions="$permissions" />
                @endforeach
            </tbody>
        </table>
    </main>
    @else
        <div class="w-3/4 p-6 bg-slate-50 min-h-screen w-full flex items-center justify-center">
            <h2 class="text-2xl font-bold text-red-600">You do not have permission to view this page.</h2>
        </div>
    @endcan
</x-app-layout>
