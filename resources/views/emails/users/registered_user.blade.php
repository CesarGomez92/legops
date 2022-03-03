@component('mail::message')
# Bienvenido a Legops

fuiste registrado exitosamente en Legops, esperamos verte pronto ;)

@component('mail::button', ['url' => $url, 'color' => 'success'])
Ingresar
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
