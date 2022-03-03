@component('mail::message')
# Reporte de usuario por pais

Esta es la ultima version del reporte de usuarios por pais:

@component('mail::table')
| Pais                    | Usuarios                  |
|:-----------------------:|:-------------------------:|
@foreach($users_by_country as $data)
| {{ $data['country'] }}  | {{ $data['users'] }}      |
@endforeach
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
