


    <x-guest-layout>
        <div class="register_three">
            <div class="images_wrap">
                @foreach($images as $image)
                    <div class="column">
                        <img src="{{ asset('images/slider-bottom/' . $image) }}" alt="">
                        <p>{{ str_replace(".jpg", "" , $image)  }}</p>
                    </div>
                @endforeach
            </div>
            <div class="form_section">

                <x-auth-card>
                        <x-slot name="logo">
                            <a href="/">
                                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                            </a>
                        </x-slot>

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
                                <form method="POST" action="{{ route('custom-email-register') }}">
                                @csrf

                                <input id="add_chat_user" type="hidden" name="add_chat_user" value="{{$addUser}}"  />
                                <input id="src" type="hidden" name="src" value="{{$src}}"  />

                                <!-- Email Address -->
                                    <div class="mt-4">
                                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required placeholder="Email"/>
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
            </div>
        </div>
    </x-guest-layout>

