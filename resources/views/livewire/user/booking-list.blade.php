<div class="py-12 px-6 md:px-12 lg:px-24 bg-gray-900 min-h-screen text-gray-100 font-sans">

    <div class="w-[90%] max-w-[1200px] mx-auto space-y-4 pt-10">

        <h2 class="text-3xl font-bold mb-6 text-center text-[#4CE9C3]">
            Daftar Booking Perbaikan
        </h2>

        <!-- Tombol buat booking baru -->
        <div class="flex justify-start mb-4">
            <a href="{{ route('booking.form') }}"
               class="bg-[#4CE9C3] text-gray-900 font-bold px-4 py-2 rounded-lg shadow hover:bg-[#38c29e] transition">
                + Buat Booking Baru
            </a>
        </div>

        <!-- Notifikasi sukses -->
        @if (session('success'))
            <div 
                x-data="{ show: true }" 
                x-show="show"
                x-init="setTimeout(() => show = false, 3000)"
                class="bg-green-600 text-white px-4 py-3 rounded-lg text-center mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Data -->
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

            <tbody wire:poll.2000ms>
                @forelse ($bookings ?? [] as $booking)
                    <tr class="border-b border-gray-700 hover:bg-gray-750 transition">
                    
                        <!-- Merek Kendaraan -->
                        <td class="py-3 px-4 font-semibold">
                            {{ $booking->vehicle->brand ?? '-' }}
                        </td>
                    
                        <!-- Nama & Type -->
                        <td class="py-3 px-4 font-semibold">
                            {{ $booking->vehicle->type ?? '-' }}
                        </td>
                    
                        <!-- Nomor Plat -->
                        <td class="py-3 px-4 font-semibold">
                            {{ $booking->vehicle->plate_number ?? '-' }}
                        </td>
                    
                        <!-- Deskripsi -->
                        <td class="py-3 px-4">
                            {{ $booking->description ?? '-' }}
                        </td>
                    
                        <!-- Status -->
                        <td class="py-3 px-4">
                            <span class="font-bold uppercase
                                @if ($booking->status === 'pending') text-yellow-400
                                @elseif ($booking->status === 'cancelled') text-red-500
                                @elseif ($booking->status === 'done') text-green-400
                                @endif">
                                {{ ucfirst($booking->status ?? '-') }}
                            </span>
                        </td>
                    
                        <!-- Aksi -->
                        <td class="py-3 px-4 text-center space-y-2">
                        
                            @if ($booking->status === 'pending')
                                <button 
                                    wire:click="cancelBooking({{ $booking->id }})"
                                    onclick="return confirm('Yakin ingin membatalkan?')"
                                    class="bg-red-600 px-3 py-1 font-bold rounded hover:bg-red-700 transition w-full block">
                                    Batalkan
                                </button>
                            @endif
                            
                            <button
                                wire:click="deleteBooking({{ $booking->id }})"
                                onclick="return confirm('Hapus permanen?')"
                                class="bg-red-800 px-3 py-1 rounded font-semibold hover:bg-red-900 transition w-full block">
                                Hapus
                            </button>
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
</div>
