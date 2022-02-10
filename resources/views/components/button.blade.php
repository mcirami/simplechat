<button {{ $attributes->merge(['type' => 'submit', 'class' =>  'button red focus:outline-none transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
