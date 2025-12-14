<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">

            <div class="bg-white shadow rounded p-4">
                <h3 class="text-lg font-bold mb-4">User Management</h3>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-sm">
                        <thead>
                            <tr class="border-b bg-gray-100">
                                <th class="p-2 text-left">Name</th>
                                <th class="p-2 text-left">Email</th>
                                <th class="p-2 text-left">Status</th>
                                <th class="p-2 text-left">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($users as $user)
                                <tr class="border-b">
                                    <td class="p-2">{{ $user->name }}</td>
                                    <td class="p-2">{{ $user->email }}</td>
                                    <td class="p-2">
                                        @if($user->is_suspended)
                                            <span class="text-red-600 font-semibold">Suspended</span>
                                        @else
                                            <span class="text-green-600 font-semibold">Active</span>
                                        @endif
                                    </td>
                                    <td class="p-2">
                                        <span class="text-gray-500 italic">
                                            (Toggle coming soon)
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
