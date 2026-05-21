<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Si tienes comandos reales (cuidados:revisar, problemas:revisar), déjalos.
// Si no existen, coméntalos o elimínalos.
Schedule::command('cuidados:revisar')->daily();
Schedule::command('problemas:revisar')->daily();

// Elimina la línea duplicada y el comando 'cuidados:notificar' que no existe.