@component('mail::message')
# Welcome to Romeo Chat!

Below you will find your login credentials:

Email: <span>{{ $data['email'] }}</span>
<br>
Password: <span>{{ $data['password'] }}</span>

@component('mail::button', ['url' => config('app.url') . "/login"])
Login Now!
@endcomponent

Thanks,<br>
Romeo Chat
@endcomponent
