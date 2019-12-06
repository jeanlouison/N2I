@isset( $error_message )
    <section role="alert">
        <p>{{ $error_message }}</p>
    </section>
@endisset
@php
    session()->forget('error_message');
@endphp
