<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-login-logo class="h-auto text-white fill-current w-52 sm:w-52 md:w-96" />
            </a>
        </x-slot>
        <x-slot name="appName">
            <h2 class="font-extrabold leading-tight tracking-widest text-white uppercase text-md drop-shadow-lg sm:text-center sm:text-xl md:text-3xl">
                {{ env('APP_NAME') }}
            </h2>
        </x-slot>
        <div class="mx-auto"></div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="username" :value="__('Username')" />

                <x-input id="username" class="block w-full mt-1" type="text" name="username" :value="old('username')"
                    required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block w-full mt-1" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="text-blue-600 border-gray-300 rounded shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('register'))
                <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('register') }}">
                    {{ __('No Account? Create One!') }}
                </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
