
<x-guest-layout>

    <x-auth-card>

        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="content_wrap">
            <div class="heading">
                <h2>Complete the form below to register as an agent</h2>
            </div>
            <div class="form_wrap register agent">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <input type="hidden" name="role" value="agent">

                    <!-- Name -->
                    <div>
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus placeholder="Name"/>
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">

                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required placeholder="Email"/>
                    </div>

                    <!-- Password -->
                    <div class="mt-4">

                        <x-input id="password" class="block mt-1 w-full"
                                 type="password"
                                 name="password"
                                 required autocomplete="new-password"
                                 placeholder="Password"
                                 required
                        />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">

                        <x-input id="password_confirmation" class="block mt-1 w-full"
                                 type="password"
                                 name="password_confirmation"
                                 placeholder="Confirm Password"
                                 required
                        />
                    </div>

                    <div class="flex items-center justify-end mt-4 button_row">
                        <a class="underline text-sm" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-button class="ml-4">
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>

    </x-auth-card>

</x-guest-layout>

