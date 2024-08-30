<x-slot:header>
    <h2>
        {{ __('User') }}
    </h2>
</x-slot>
<div class="bg-primary-100 rounded-lg">
    <div class="flex items-center gap-3 p-4 font-semibold">
        <x-antdesign-user-o class="h-10 w-10" />
        <h3>
            Orang Tua
        </h3>
    </div>

    <div class="flex flex-col gap-4 p-4 md:flex-row md:justify-between">
        <div class="flex items-center gap-2">
            <h4 class="font-semibold">Show</h4>
            <select wire:model.live="perPage"
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="40">40</option>
                <option value="50">50</option>
            </select>
            <p class="">entries</p>
        </div>
        <div class="flex items-center gap-2">
            <label for="search"
                   class="font-semibold">Search</label>
            <x-text-input id="search"
                          type="text"
                          name="search"
                          wire:model.live.debounce.500ms="search"
                          placeholder="Search..."
                          size="sm" />
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right ">
            <thead class="text-sm bg-primary-200">
                <tr>
                    <th scope="col"
                        class="px-6 py-3">
                        No
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Nama
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Siswa
                    </th>
                    <th scope="col"
                        class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>

                @forelse ($this->users as $user)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-primary-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $loop->iteration }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $user->name }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $user->email }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            {{ $user->studentParent->hubungan ?? 'Belum diatur' }}
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            @isset($user->studentParent)
                                {{ $user->studentParent->child->name ?? 'Belum diatur' }}
                            @endisset
                        </td>
                        <td scope="col"
                            class="px-6 py-3">
                            <div class="flex gap-2">

                                <a class="text-xs bg-primary-900 p-1 px-2 rounded text-white cursor-pointer"
                                   href="{{ route('admin.user.show', $user) }}"
                                   wire:navigate>
                                    Detail
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-primary-50  even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <td scope="col"
                            class="px-6 py-3"
                            colspan="6">
                            Data tidak ditemukan
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="p-5">
            {{ $this->users->links() }}
        </div>

    </div>
</div>

