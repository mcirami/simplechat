<div class="min-h-screen flex justify-center items-center pt-6 sm:pt-0">
    <div class="card_content">
        <div class="logo">
            {{--{{ $logo }}--}}
            <img src="{{asset('images/logo.png')}}" alt="" />
        </div>
        <div class="container">
            <div class="w-full mt-6 overflow-hidden white_box">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
