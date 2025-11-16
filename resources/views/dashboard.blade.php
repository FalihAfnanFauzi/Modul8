<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-md mt-6">
                <h3 class="text-lg font-semibold mb-4">Upload Berkas</h3>
                <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label for="file" class="block font-medium text-sm text-gray-700">Pilih Berkas</label>
                        <input type="file" name="file" id="file" class="mt-2 border-gray-300 rounded-md shadow-sm w-full">
                    </div>
                    <div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Upload
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Daftar File</h3>
                    <table class="w-full table-auto border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-2 text-left">Nama File</th>
                                <th class="border p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Models\Upload::all() as $file)
                                <tr>
                                    <td class="border p-2">
                                        <a href="{{ asset('storage/' . $file->filepath) }}" target="_blank" class="text-blue-600 hover:underline">{{ $file->filename }}</a>
                                    </td>
                                    <td class="border p-2 text-center">
                                        @if(auth()->user()->isAdmin() || auth()->id() === $file->user_id)
                                            <form action="{{ route('upload.destroy', $file->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus file ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700">Hapus</button>
                                            </form>
                                        @else
                                            <span class="text-gray-500">Tidak ada aksi</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if(auth()->user()->isAdmin())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">Daftar User</h3>
                        <table class="w-full table-auto border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border p-2 text-left">Nama</th>
                                    <th class="border p-2 text-left">Email</th>
                                    <th class="border p-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Models\User::all() as $user)
                                    <tr>
                                        <td class="border p-2">{{ $user->name }}</td>
                                        <td class="border p-2">{{ $user->email }}</td>
                                        <td class="border p-2 text-center">
                                            @if($user->id !== auth()->id())
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus user ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700">Hapus User</button>
                                                </form>
                                            @else
                                                <span class="text-gray-500">Anda</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
