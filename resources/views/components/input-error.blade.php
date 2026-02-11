@props(['messages'])

@if ($messages)
    {{-- ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul> --}}

   @foreach ( $messages as $message)
        <span {{ $attributes-> merge(['class' => 'text-danger']) }}>{{ $message }}</span>
   @endforeach
@endif
