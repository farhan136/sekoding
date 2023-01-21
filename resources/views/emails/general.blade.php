<x-mail::message>
# Introduction

Hi {{$user->name}}.
<br>
Welcome to Sekoding, your account has been created successfully. Now you can choose your camp and start learning.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
