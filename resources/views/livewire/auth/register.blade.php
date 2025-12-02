

<div class="flex items-center justify-center w-full">
  <div class="flex flex-col w-full max-w-md px-3 mx-auto shrink-0">
    <div class="relative flex flex-col min-w-0 break-words border-0 rounded-2xl p-6" 
      style="background-color: #374151; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.4), 0 4px 6px -2px rgba(0, 0, 0, 0.3);">

      {{-- HEADER --}}
      <div class="p-6 pb-0 mb-0 text-center">
        <h4 class="font-bold text-2xl" style="color: #f9fafb;">Register</h4>
        <p class="mb-0" style="color: #9ca3af;">Create your new account</p>
      </div>

      {{-- ALERT --}}
      @if (session('success'))
        <div class="px-4 py-2 rounded-lg mt-4" style="background-color: #065f46; color: #a7f3d0;">
          {{ session('success') }}
        </div>
      @endif

      {{-- FORM --}}
      <div class="flex-auto p-6">
        <form wire:submit.prevent="register">

          {{-- NAME --}}
          <div class="mb-4">
            <input type="text" wire:model="name" placeholder="Full Name"
              class="text-sm block w-full rounded-lg p-3 focus:border-green-400 focus:ring focus:ring-green-100 focus:outline-none"
              style="border: 1px solid #4b5563; background-color: #4b5563; color: #d1d5db;">
            @error('name') <span class="text-sm" style="color: #f87171;">{{ $message }}</span> @enderror
          </div>

          {{-- EMAIL --}}
          <div class="mb-4">
            <input type="email" wire:model="email" placeholder="Email Address"
              class="text-sm block w-full rounded-lg p-3 focus:border-green-400 focus:ring focus:ring-green-100 focus:outline-none"
              style="border: 1px solid #4b5563; background-color: #4b5563; color: #d1d5db;">
            @error('email') <span class="text-sm" style="color: #f87171;">{{ $message }}</span> @enderror
          </div>

          {{-- PASSWORD --}}
          <div class="mb-4">
            <input type="password" wire:model="password" placeholder="Password"
              class="text-sm block w-full rounded-lg p-3 focus:border-green-400 focus:ring focus:ring-green-100 focus:outline-none"
              style="border: 1px solid #4b5563; background-color: #4b5563; color: #d1d5db;">
            @error('password') <span class="text-sm" style="color: #f87171;">{{ $message }}</span> @enderror
          </div>

          {{-- CONFIRM --}}
          <div class="mb-4">
            <input type="password" wire:model="password_confirmation" placeholder="Confirm Password"
              class="text-sm block w-full rounded-lg p-3 focus:border-green-400 focus:ring focus:ring-green-100 focus:outline-none"
              style="border: 1px solid #4b5563; background-color: #4b5563; color: #d1d5db;">
            @error('password_confirmation') <span class="text-sm" style="color: #f87171;">{{ $message }}</span> @enderror
          </div>

          {{-- TERMS --}}
          <div class="flex items-center mb-4">
            <input id="terms" type="checkbox" wire:model="terms"
              class="mr-2 rounded" style="accent-color: #4CE9C3;">
            <label for="terms" class="text-sm" style="color: #9ca3af;">I agree to the Terms</label>
          </div>
          @error('terms') <span class="text-sm" style="color: #f87171;">{{ $message }}</span> @enderror

          <button type="submit"
            class="w-full py-3 mt-4 font-bold rounded-lg transition-all"
            style="background-color: #4CE9C3; color: #111827;">
            Create Account
          </button>
        </form>
      </div>

      {{-- LINK --}}
      <div class="text-center mt-4">
        <p class="text-sm" style="color: #9ca3af;">
          Already have an account?
          <a href="{{ url('login') }}" class="font-semibold hover:underline" style="color: #4CE9C3;">
            Sign in
          </a>
        </p>
      </div>
      
    </div>
  </div>
</div>

