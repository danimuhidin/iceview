<x-mail::message>
    # Hello, {{ $user->name }}!

    Welcome to {{ config('app.name') }}. Your account has been successfully created.

    Here are your login credentials:
    **Email:** {{ $user->email }}
    **Password:** {{ $password }}

    <x-mail::button :url="config('app.url')">
        Visit {{ config('app.name') }}
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
