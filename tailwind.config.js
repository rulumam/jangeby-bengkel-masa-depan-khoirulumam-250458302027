// tailwind.config.js
/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        // Jalur Standar Laravel
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",

        // PENTING: Jalur Livewire Components Anda
        // Ini akan memindai folder livewire di resources/views
        "./resources/views/livewire/**/*.blade.php", 
        // Jika ada class di file PHP Livewire, tambahkan juga:
        "./app/Http/Livewire/*.php",
    ],
    theme: {
        extend: {
            // Definisikan warna kustom #4CE9C3 agar mudah dipakai
            colors: {
                'accent-mint': '#4CE9C3',
            },
        },
    },
    plugins: [],
}