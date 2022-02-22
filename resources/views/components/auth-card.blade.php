<div class="min-h-screen flex flex-col sm:justify-center items-center bg-gray-100 py-12">
    <div>
        {{ $logo }}
    </div>

    <div class="container">
    <div class="w-full mt-6 white_box @if(Route::is('register') ) bg-gray-100 @endif;">
        {{ $slot }}
    </div>
    </div>
</div>
