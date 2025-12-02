<div class="p-6 md:p-8 min-h-screen bg-gray-900 text-gray-100">

    <h2 class="text-2xl font-bold mb-6">Payment List</h2>

    <!-- 🔍 Search -->
    <div class="mb-4">
        <input
            type="text"
            wire:model.live="search"
            placeholder="Cari kendaraan / plat / user..."
            class="w-72 px-4 py-2 rounded-lg bg-gray-800 border border-gray-700 text-gray-200
                   focus:ring-2 focus:ring-[#4CE9C3] focus:outline-none"
        />
    </div>

    <table class="w-full text-gray-200 bg-gray-800 rounded-xl overflow-hidden shadow-lg">
        <thead class="bg-gray-700 text-gray-300 uppercase text-sm">
            <tr>
                <th class="py-3 px-4 text-left">User</th>
                <th class="py-3 px-4 text-left">Merek</th>
                <th class="py-3 px-4 text-left">Nama Kendaraan</th>
                <th class="py-3 px-4 text-left">Plat</th>
                <th class="py-3 px-4 text-left">Deskripsi Kerusakan</th>
                <th class="py-3 px-4 text-left">Status</th>
                <th class="py-3 px-4 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($repairs as $repair)
                <tr class="border-b border-gray-700 hover:bg-gray-750 transition">
                    <td class="py-3 px-4 font-semibold">{{ $repair->user->name ?? '-' }}</td>
                    <td class="py-3 px-4 font-semibold">{{ $repair->vehicle->brand ?? '-' }}</td>
                    <td class="py-3 px-4 font-semibold">{{ $repair->vehicle->type ?? '' }}</td>
                    <td class="py-3 px-4 font-semibold">{{ $repair->vehicle->plate_number ?? '-' }}</td>
                    <td class="py-3 px-4">{{ Str::limit($repair->description, 30) ?? '-' }}</td>

                    <td class="py-3 px-4">
                        @if ($repair->payment)
    <span class="font-bold uppercase text-green-400">
        {{ strtoupper($repair->payment->status) }}
    </span>
@endif

                    </td>

                    <td class="py-3 px-4 flex justify-center">
                        @if($repair->payment)
                            <a href="{{ Storage::url(optional($repair->payment)->proof) }}" target="_blank"
                                class="px-4 py-2 rounded-lg font-semibold text-sm bg-green-600 hover:bg-green-700 text-gray-100 shadow-md">
                                Lihat Bukti
                            </a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-6 text-gray-400">
                        Belum ada data pembayaran.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $repairs->links() }}
    </div>

    <div
        x-data="{ open: false, imageUrl: '' }"
        x-on:openProofModal.window="open = true; imageUrl = $event.detail.imageUrl"
        x-show="open"
        x-transition
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50"
        style="display: none;"
    >
        <div class="bg-gray-800 rounded-lg p-6 w-96 text-center">
            <h3 class="text-lg font-bold mb-3">Bukti Pembayaran</h3>

            <img :src="imageUrl" alt="Bukti" class="w-full rounded-lg mb-4 border border-gray-700">

            <button @click="open = false"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg">
                Tutup
            </button>
        </div>
    </div>

</div>

@push('scripts')
<script>
    window.addEventListener('openProofModal', event => {
        const modal = new CustomEvent('openProofModal', {
            detail: { imageUrl: event.detail.imageUrl }
        });
        window.dispatchEvent(modal);
    });
</script>
@endpush
