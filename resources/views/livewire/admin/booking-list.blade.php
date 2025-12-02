<div class="p-6 md:p-8 min-h-screen bg-gray-900 text-gray-100">

    <h2 class="text-2xl font-bold mb-6">Booking List</h2>

    {{-- 🔍 SEARCH --}}
    <div class="mb-4">
        <input 
            type="text" 
            wire:model.live="search"
            placeholder="Cari berdasarkan nama kendaraan, type, plat, atau status..."
            class="w-full md:w-1/3 bg-gray-800 border border-gray-700 text-gray-200 placeholder-gray-400 
                   px-4 py-2 rounded-lg focus:ring-2 focus:ring-[#4CE9C3] focus:outline-none"
        >
    </div>

    <table class="w-full text-gray-200 bg-gray-800 rounded-xl overflow-hidden shadow-lg">
        <thead class="bg-gray-700 text-gray-300 uppercase text-sm">
            <tr>
                <th class="py-3 px-4 text-left">Merek Kendaraan</th>
                <th class="py-3 px-4 text-left">Nama & Type</th>
                <th class="py-3 px-4 text-left">Nomor Plat</th>
                <th class="py-3 px-4 text-left">Deskripsi Kerusakan</th>
                <th class="py-3 px-4 text-left">Status</th>
                <th class="py-3 px-4 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($bookings as $booking)
                <tr class="border-b border-gray-700 hover:bg-gray-750 transition">

                    <td class="py-3 px-4 font-semibold">
                        {{ $booking->vehicle->brand ?? '-' }}
                    </td>

                    <td class="py-3 px-4 font-semibold">
                        {{ $booking->vehicle->type ?? '-' }}
                    </td>

                    <td class="py-3 px-4 font-semibold">
                        {{ $booking->vehicle->plate_number ?? '-' }}
                    </td>

                    <td class="py-3 px-4">
                        {{ $booking->description ?? '-' }}
                    </td>

                    <td class="py-3 px-4">
                        <span class="font-bold uppercase
                            @if ($booking->status == 'pending') text-yellow-400
                            @elseif ($booking->status == 'process') text-blue-400
                            @elseif ($booking->status == 'cancelled') text-red-500
                            @elseif ($booking->status == 'done') text-green-400
                            @endif">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>

                    <td class="py-3 px-4 border-b border-gray-800 flex gap-3">

                        {{-- Jika sudah dibayar ATAU user yang membatalkan --}}
                        @if ($booking->status === 'paid' || $booking->status === 'cancelled')
                            <button 
                                wire:click="deleteBooking({{ $booking->id }})"
                                class="px-3 py-1 rounded-lg font-semibold transition
                                    bg-red-700/40 text-red-400 border border-red-600
                                    hover:bg-red-600 hover:text-white">
                                Hapus
                            </button>

                        @else
                            {{-- Terima --}}
                            <button wire:click="updateStatus({{ $booking->id }}, 'approved')"
                                class="px-3 py-1 rounded-lg font-semibold transition
                                    bg-[#4CE9C320] text-[#4CE9C3] border border-[#4CE9C3]
                                    hover:bg-[#4CE9C3] hover:text-gray-900">
                                Terima
                            </button>

                            {{-- Batal --}}
                            <button wire:click="updateStatus({{ $booking->id }}, 'cancelled')"
                                class="px-3 py-1 rounded-lg font-semibold transition
                                    bg-red-800/30 text-red-400 border border-red-600
                                    hover:bg-red-600 hover:text-white">
                                Batal
                            </button>
                        @endif

                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-6 text-gray-400">
                        Belum ada booking perbaikan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
