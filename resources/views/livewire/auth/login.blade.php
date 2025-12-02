
<div class="flex items-center justify-center w-full">
  <div class="flex flex-col w-full max-w-md px-3 mx-auto shrink-0">
    <div class="relative flex flex-col min-w-0 break-words border-0 rounded-2xl p-6" 
    style="background-color: #374151; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.4), 0 4px 6px -2px rgba(0, 0, 0, 0.3);">
    
    <div class="p-6 pb-0 mb-0 text-center">
      <h4 class="font-bold text-2xl" style="color: #f9fafb;">Sign In</h4>
        <p class="mb-0" style="color: #9ca3af;">Enter your email and password to sign in</p>
      </div>

      {{-- ALERT MESSAGES --}}
      @if (session('success'))
        <div class="px-4 py-2 rounded-lg mt-4" style="background-color: #065f46; color: #a7f3d0;">
          {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="px-4 py-2 rounded-lg mt-4" style="background-color: #991b1b; color: #fecaca;">
          {{ session('error') }}
        </div>
      @endif

      {{-- FORM LOGIN --}}
      <div class="flex-auto p-6">
        <form wire:submit.prevent="login">
          <div class="mb-4">
            <input type="email" wire:model="email" placeholder="Email"
            class="text-sm block w-full rounded-lg p-3 focus:border-green-400 focus:ring focus:ring-green-100 focus:outline-none" 
              style="border: 1px solid #4b5563; background-color: #4b5563; color: #d1d5db;">
              @error('email') <span class="text-sm" style="color: #f87171;">{{ $message }}</span> @enderror
          </div>

          <div class="mb-4 relative" x-data="{ show: false }">
            <input 
            :type="show ? 'text' : 'password'" 
              wire:model="password" 
              placeholder="Password"
              class="text-sm block w-full rounded-lg p-3 pr-10 focus:border-green-400 focus:ring focus:ring-green-100 focus:outline-none" 
              style="border: 1px solid #4b5563; background-color: #4b5563; color: #d1d5db; height: 44px;">
              
            <button type="button" @click="show = !show" 
              class="absolute right-0 flex items-center pr-3 cursor-pointer"
              style="color: #9ca3af; top: 50%; transform: translateY(-50%); border: none; background: none;">
              
              <span x-show="!show">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                  <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                  <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                </svg>
              </span>
              
              <span x-show="show">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.958 10.958 0 0020 10c-1.274 4.057-5.064 7-9.542 7-1.254 0-2.47.214-3.575.638l-1.45-1.45zM10 17c-2.757 0-5.46-1.545-7.391-4.721L2 13.914l1.378-1.378 2.053 2.053C7.458 15.82 8.718 16 10 16a6 6 0 005.148-3.036l-2.077-2.077a4 4 0 01-3.071 1.777 4 4 0 01-4-4 4 4 0 011.777-3.071l-2.077-2.077L.086 5.379l1.414-1.414L3.707 2.293zm5.787 5.787a1 1 0 001.414-1.414L16.293 17.5l-1.414 1.414z" clip-rule="evenodd" />
                </svg>
              </span>
            </button>
            @error('password') <span class="text-sm" style="color: #f87171;">{{ $message }}</span> @enderror
          </div>

          <div class="flex items-center mb-4">
            <input id="rememberMe" type="checkbox" wire:model="rememberMe"
            class="mr-2 rounded"
            style="accent-color: #4CE9C3; border-color: #4b5563; background-color: #4b5563;">
            <label for="rememberMe" class="text-sm" style="color: #9ca3af;">Remember me</label>
          </div>

          <div class="text-center">
            <button type="submit"
            class="w-full py-3 mt-4 font-bold rounded-lg transition-all"
              style="background-color: #4CE9C3; color: #111827;">
              Sign In
            </button>
          </div>
        </form>
      </div>

      <div class="text-center mt-4">
        <p class="text-sm" style="color: #9ca3af;">
          Don't have an account?
          <a href="{{ url('register') }}" class="font-semibold hover:underline" style="color: #4CE9C3;">
            Sign up
          </a>
        </p>
      </div>
      
    </div>
  </div>
</div>



