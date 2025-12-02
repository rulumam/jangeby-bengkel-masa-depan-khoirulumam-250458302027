<div class="p-6 md:p-8 min-h-screen bg-gray-900 text-gray-100">

    <h2 class="text-2xl font-bold mb-6">Repair List</h2>

    <!-- 🔍 SEARCH BAR -->
    <div class="mb-4">
        <input 
            type="text" 
            wire:model.live="search"
            placeholder="Cari kendaraan / plat / deskripsi / user..."
            class="w-72 px-4 py-2 rounded-lg bg-gray-800 border border-gray-700 text-gray-200 
                   focus:ring-2 focus:ring-[#4CE9C3] focus:outline-none"
        />
    </div>

    <table class="w-full text-gray-200 bg-gray-800 rounded-xl overflow-hidden shadow-lg">
        <thead class="bg-gray-700 text-gray-300 uppercase text-sm">
            <tr>
                <th class="py-3 px-4 text-left">User</th>
                <th class="py-3 px-4 text-left">Merek Kendaraan</th>
                <th class="py-3 px-4 text-left">Nama & Type</th>
                <th class="py-3 px-4 text-left">Nomor Plat</th>
                <th class="py-3 px-4 text-left">Deskripsi Kerusakan</th>
                <th class="py-3 px-4 text-left">Status</th>
                <th class="py-3 px-4 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($repairs as $repair)
                <tr class="border-b border-gray-700 hover:bg-gray-750 transition">

                    <!-- Tampilkan User -->
                    <td class="py-3 px-4 font-semibold">
                        {{ $repair->user->name ?? $repair->user->username ?? '-' }}
                    </td>

                    <td class="py-3 px-4 font-semibold">
                        {{ $repair->vehicle->brand ?? '-' }}
                    </td>
 
                    <td class="py-3 px-4 font-semibold">
                        {{ $repair->vehicle->type ?? '-' }}
                    </td>

                    <td class="py-3 px-4 font-semibold">
                        {{ $repair->vehicle->plate_number ?? '-' }}
                    </td>

                    <td class="py-3 px-4">
                        {{ $repair->description ?? '-' }}
                    </td>

                    <td class="py-3 px-4">
                        <span class="font-bold uppercase
                            @if ($repair->status == 'pending') text-yellow-400
                            @elseif ($repair->status == 'process') text-blue-400
                            @elseif ($repair->status == 'cancelled') text-red-500
                            @elseif ($repair->status == 'done') text-green-400
                            @elseif ($repair->status == 'paid') text-purple-400
                            @endif">
                            {{ strtoupper($repair->status) }}
                        </span>
                    </td>

                    <td class="py-3 px-4 border-b border-gray-800 flex gap-3">

                        @if ($repair->status === 'paid' || $repair->status === 'cancelled')
                            <button 
                                wire:click="deleteRepair({{ $repair->id }})"
                                class="px-3 py-1 rounded-lg font-semibold transition
                                       bg-red-700/40 text-red-400 border border-red-600
                                       hover:bg-red-600 hover:text-white">
                                Hapus
                            </button>
                        @else
                            <button wire:click="updateStatus({{ $repair->id }}, 'process')"
                                class="px-3 py-1 rounded-lg font-semibold transition
                                       bg-[#4CE9C320] text-[#4CE9C3] border border-[#4CE9C3]
                                       hover:bg-[#4CE9C3] hover:text-gray-900">
                                Terima
                            </button>

                            <button wire:click="updateStatus({{ $repair->id }}, 'cancelled')"
                                class="px-3 py-1 rounded-lg font-semibold transition
                                       bg-red-800/30 text-red-400 border border-red-600
                                       hover:bg-red-600 hover:text-white">
                                Batal
                            </button>

                            <button wire:click="updateStatus({{ $repair->id }}, 'done')"
                                class="px-3 py-1 rounded-lg font-semibold transition
                                       bg-emerald-800/30 text-emerald-400 border border-emerald-500
                                       hover:bg-emerald-500 hover:text-gray-900">
                                Selesai
                            </button>
                        @endif

                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-6 text-gray-400">
                        Belum ada repair yang masuk.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
