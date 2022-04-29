
<x-guest-layout>


        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="content_wrap custom_four">



            <div class="my_row form_wrap register d-none">
                <div class="heading my_row">
                    <h2>HoneyKatty sent you a private chat invite!</h2>
                </div>
                <form method="POST" action="{{ route('custom-email-register') }}">
                    @csrf

                    <!-- UserName -->
                    <input id="add_chat_user" type="hidden" name="add_chat_user" value="{{$addUser}}"  />
                    <input id="src" type="hidden" name="src" value="{{$src}}"  />

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required placeholder="Email"/>
                    </div>

                    <div class="flex items-center justify-end mt-4 button_row">
                        {{--<a class="underline text-sm" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>--}}

                        <x-button class="ml-4">
                            {{ __('Accept Invite') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>


</x-guest-layout>
