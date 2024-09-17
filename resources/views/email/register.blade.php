@component('mail::message')

<p>Hellow {{$user->name}}</p>

@component('mail::button', url(['verify/' . $user['remember_token']]))
    Verify
@endcomponent
<p>in any problem reach our Admin </p>

Thanks <hr/>

{{config('app.name')}}
@endcomponent


