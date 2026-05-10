<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ReporteProblema;
use Carbon\Carbon;

class RevisarProblemas extends Command
{
    protected $signature = 'problemas:revisar';

    protected $description = 'Revisa problemas en revisión y los marca como resueltos automáticamente';

    public function handle()
    {
        $limite = Carbon::now()->subDays(3);

        $reportes = ReporteProblema::where('estado', 'en_revision')
            ->where('updated_at', '<=', $limite)
            ->get();

        foreach ($reportes as $reporte) {
            $reporte->update([
                'estado' => 'resuelto'
            ]);

            $this->info("Problema {$reporte->id} marcado como resuelto.");
        }

        $this->info('Revisión automática completada.');
    }
}