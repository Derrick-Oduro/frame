<aside class="w-1/5 bg-blue-900 min-h-screen p-4">
        <nav class="space-y-4">
            @role('admin|editor|author')
            <a href="{{ route('dashboard') }}"class="{{ request()->is('dashboard') ? 'bg-blue-800' : 'bg-blue-900' }} block px-4 py-2 rounded hover:bg-blue-600 text-white">Dashboard</a>
            <a href="{{ route('posts.index') }}"class="{{ request()->is('posts') ? 'bg-blue-800' : 'bg-blue-900' }} block px-4 py-2 rounded hover:bg-blue-600 text-white">Posts</a>
            <a href="{{ route('categories.index') }}"class="{{ request()->is('categories') ? 'bg-blue-800' : 'bg-blue-900' }} block px-4 py-2 rounded hover:bg-blue-600 text-white">Categories</a>
            @endrole
            @role('admin')
            <a href="{{ route('roles.index') }}"class="{{ request()->is('role') ? 'bg-blue-800' : 'bg-blue-900' }} block px-4 py-2 rounded hover:bg-blue-600 text-white">Asign Roles</a>
            @endrole
            @role('admin|super-admin')
            <a href="{{ route('users.index') }}"class="{{ request()->is('users') ? 'bg-blue-800' : 'bg-blue-900' }} block px-4 py-2 rounded hover:bg-blue-600 text-white">Users</a>
            @endrole
            @role('super-admin')
            <a href="{{ route('tenants.index') }}"class="{{ request()->is('tenants') ? 'bg-blue-800' : 'bg-blue-900' }} block px-4 py-2 rounded hover:bg-blue-600 text-white">Tenants</a>
            <a href="{{ route('permissions.index') }}"class="{{ request()->is('permissions') ? 'bg-blue-800' : 'bg-blue-900' }} block px-4 py-2 rounded hover:bg-blue-600 text-white">Role Management</a>
            @endrole

        </nav>
</aside>
