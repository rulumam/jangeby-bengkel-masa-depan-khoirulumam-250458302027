<div class="py-10 px-6 bg-gray-900 min-h-screen text-gray-100">

    <h2 class="text-4xl font-bold text-[#4CE9C3] mb-10 text-center">
        Pembayaran Perbaikan
    </h2>

    <!-- Flash Message -->
    @if (session('success'))
        <div 
            x-data="{ show: true }" 
            x-show="show"
            x-init="setTimeout(() => show = false, 3000)"
            class="bg-green-600 text-white px-4 py-3 rounded-lg text-center mb-8 max-w-3xl mx-auto">
            {{ session('success') }}
        </div>
    @endif

    <!-- FORM UPLOAD -->
    <form wire:submit.prevent="uploadPayment" 
          class="max-w-3xl mx-auto bg-gray-800 p-8 rounded-xl space-y-8 shadow-lg"
          enctype="multipart/form-data">

        <!-- Informasi Kendaraan -->
        <div class="space-y-4">
            <div>
                <label class="block font-semibold mb-1">Merek Kendaraan</label>
                <input type="text" class="w-full bg-gray-700 p-3 rounded-lg" 
                       value="{{ $repair->vehicle->brand }}" disabled>
            </div>

            <div>
                <label class="block font-semibold mb-1">Tipe Kendaraan</label>
                <input type="text" class="w-full bg-gray-700 p-3 rounded-lg" 
                       value="{{ $repair->vehicle->type }}" disabled>
            </div>

            <div>
                <label class="block font-semibold mb-1">Nomor Plat</label>
                <input type="text" class="w-full bg-gray-700 p-3 rounded-lg" 
                       value="{{ $repair->vehicle->plate_number }}" disabled>
            </div>

            <div>
                <label class="block font-semibold mb-1">Deskripsi Perbaikan</label>
                <textarea class="w-full bg-gray-700 p-3 rounded-lg" disabled>{{ $repair->description }}</textarea>
            </div>

            <div>
                <label class="block font-semibold ">Status</label>
                <input type="text" class="w-full bg-gray-700 p-3 rounded-lg text-green-300 font-bold" 
                       value="{{ ucfirst($repair->status) }}" disabled>
            </div>
        </div>

        <!-- Upload Bukti Pembayaran -->
        <div>
            <label class="block font-semibold mb-2">Upload Bukti Pembayaran</label>
            <input type="file" wire:model="payment_proof"
                   class="w-full bg-gray-700 p-3 rounded-lg">

            @error('payment_proof')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror

            @if ($payment_proof)
                @php
                    $ext = strtolower($payment_proof->getClientOriginalExtension());
                @endphp

                @if(in_array($ext, ['png','jpg','jpeg','gif','bmp','svg','avif']))
                    <p class="mt-3 text-green-400 text-sm">Preview:</p>
                    <img src="{{ $payment_proof->temporaryUrl() }}" class="w-40 rounded-lg mt-2">
                @else
                    <p class="mt-3 text-yellow-400 text-sm">Preview tidak tersedia untuk tipe file ini.</p>
                @endif
            @endif
        </div>

        <!-- Tombol Submit -->
        <div>
            <button type="submit"
                class="w-full bg-[#4CE9C3] text-gray-900 font-bold py-3 rounded-lg hover:bg-[#38c29e] transition text-lg">
                Upload & Bayar
            </button>
        </div>

    </form>

</div>
