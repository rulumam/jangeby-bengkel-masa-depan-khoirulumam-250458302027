

    <div class="py-12 px-6 md:px-12 lg:px-24 bg-gray-900 min-h-screen text-gray-100 font-sans">

        <div class="max-w-2xl mx-auto">
            <h2 class="text-3xl font-extrabold mb-8 text-center text-[#4CE9C3]">
                Buat Laporan Perbaikan Kendaraan
            </h2>

            @if (session()->has('success'))
                <div class="bg-green-700 text-green-100 p-4 rounded-xl mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <form wire:submit.prevent="submit" class="space-y-6 bg-gray-800 p-8 rounded-2xl shadow-lg">

                <div>
                    <label class="block text-sm font-semibold mb-2">Merek Kendaraan</label>
                    <input type="text" wire:model="brand"
                        class="w-full bg-gray-700 border border-gray-600 text-gray-100 p-3.5 rounded focus:ring-2 focus:ring-[#4CE9C3]"
                        placeholder="Contoh: Honda, Yamaha, Suzuki">
                    @error('brand') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">Nama Kendaraan & Type</label>
                    <input type="text" wire:model="type"
                        class="w-full bg-gray-700 border border-gray-600 text-gray-100 p-3.5 rounded focus:ring-2 focus:ring-[#4CE9C3]"
                        placeholder="Contoh: Beat Street, Vario 125">
                    @error('type') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">Nomor Plat</label>
                    <input type="text" wire:model="plate_number"
                        class="w-full bg-gray-700 border border-gray-600 text-gray-100 p-3.5 rounded focus:ring-2 focus:ring-[#4CE9C3]"
                        placeholder="Contoh: B 1234 ASD">
                    @error('plate_number') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">Deskripsi Kerusakan</label>
                    <textarea wire:model="description" rows="5"
                        class="w-full bg-gray-700 border border-gray-600 text-gray-100 p-3.5 rounded-xl focus:ring-2 focus:ring-[#4CE9C3]"
                        placeholder="Contoh: Mesin berisik dan oli sering bocor."></textarea>
                    @error('description') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit"
                    class="w-full bg-[#4CE9C3] text-gray-900 font-extrabold text-lg py-3 rounded-xl hover:bg-[#38c29e] transition-all">
                    Kirim Laporan
                </button>

            </form>
        </div>

    </div>


