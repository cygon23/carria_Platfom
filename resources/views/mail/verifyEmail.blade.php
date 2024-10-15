@component('mail::message')
    <p>Hellow {{ $user->name }}</p>

    @component('mail::button', ['url' => url('verify/' . $user->remember_token)])
        verify
    @endcomponent
    <p>In any case Contact us its our pleasure to save you</p>
    Thanks <br>
    {{ config('app.name') }}
@endcomponent
