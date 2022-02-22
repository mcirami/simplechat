
<x-guest-layout>
        <x-auth-card>

                <x-slot name="logo">
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    </a>
                </x-slot>

                <div id="top_slider" class="my_row"></div>
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <div class="content_wrap">
                    <div class="heading my_row">
                        <h2>Enter your email to chat live <span>FREE!</span></h2>
                    </div>
                    <div class="my_row form_wrap {{ $addUser ? '' : 'alt' }} register"
                         {{--style="
                             background: url({{ asset('storage/agent-images/' . $addUser . '.jpg')}}) no-repeat;
                             background-size: contain;
                             background-position: left;"--}}>
                        <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- UserName -->

                            <input id="add_chat_user" type="hidden" name="add_chat_user" value="{{$addUser}}"  />
                            <input id="src" type="hidden" name="src" value="{{$src}}"  />
                            <!-- Name -->
                            {{--<div>
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus placeholder="Name"/>
                            </div>--}}

                            <!-- Email Address -->
                            <div class="mt-4">

                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required placeholder="Email"/>
                            </div>

                            <!-- Password -->
                            {{--<div class="mt-4">

                                <x-input id="password" class="block mt-1 w-full"
                                         type="password"
                                         name="password"
                                         required autocomplete="new-password"
                                         placeholder="Password"
                                         required
                                />
                            </div>--}}

                            <!-- Confirm Password -->
                            {{--<div class="mt-4">

                                <x-input id="password_confirmation" class="block mt-1 w-full"
                                         type="password"
                                         name="password_confirmation"
                                         placeholder="Confirm Password"
                                         required
                                />
                            </div>--}}

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
            <div id="bottom_slider" class="my_row"></div>

        </x-auth-card>

</x-guest-layout>

