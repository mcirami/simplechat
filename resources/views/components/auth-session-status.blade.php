@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600 session_text']) }}>
        <p>{{ $status }}</p>
    </div>
@endif
