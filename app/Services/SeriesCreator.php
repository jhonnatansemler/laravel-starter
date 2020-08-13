<?php
namespace App\Services;

use App\Serie;
use App\Temporada;
use Illuminate\Support\Facades\DB;

class SeriesCreator {
    public function createSerie(string $nome, int $temporadas, int $episodios): Serie
    {
        DB::beginTransaction();
        $serie = Serie::create(['nome' => $nome]);
        $this->createSeason($serie, $temporadas, $episodios);
        DB::commit();

        return $serie;
    }

    private function createSeason(Serie $serie, int $temporadas, int $episodios)
    {
        for($i=0; $i<$temporadas; $i++){
            $temporada = $serie->temporadas()->create(['numero' => ($i+1)]);
            $this->createEpisode($temporada, $episodios);
        }
    }

    private function createEpisode(Temporada $temporada, int $episodios)
    {
        for ($j=0; $j < $episodios; $j++) {
            $episodio = $temporada->episodios()->create(['numero' => ($j+1)]);
        }
    }
}
