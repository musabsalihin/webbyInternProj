<x-mail::message>
# Introduction

This is a reminder email.

<x-mail::button :url="'post.show'">
Go to Website
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
