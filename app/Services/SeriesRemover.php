<?php
namespace App\Services;

use App\Serie;
use App\Temporada;
use Illuminate\Support\Facades\DB;

class SeriesRemover {
    public function removeSerie(int $serieID): string {

        $nomeSerie = "";

        DB::transaction(function () use (&$nomeSerie, $serieID) {

            $serie = Serie::find($serieID);

            $nomeSerie = $serie->nome;

            $this->removeTemporada($serie);

            $serie->delete();
        });

        return $nomeSerie;
    }

    private function removeTemporada(Serie $serie)
    {
        $serie->temporadas->each(function ($temporada)
        {
            $this->removeEpisodios($temporada);

            $temporada->delete();
        });
    }

    private function removeEpisodios(Temporada $temporada)
    {
        $temporada->episodios->each(function($episodio){
            $episodio->delete();
        });
    }
}
