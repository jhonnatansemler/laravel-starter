<?php

namespace Tests\Unit;

use App\Serie;
use App\Services\SeriesCreator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeriesCreatorTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateSerie()
    {
        $serieCreator = new SeriesCreator();

        $serieName = "Nome de série";

        $createdSerie = $serieCreator->createSerie($serieName, 1, 1);

        $this->assertInstanceOf(Serie::class, $createdSerie);

        $this->assertDatabaseHas('series', ['nome'=>$serieName]);
        $this->assertDatabaseHas('temporadas', ['serie_id' => $createdSerie->id, 'numero' => 1]);
        $this->assertDatabaseHas('episodios', ['numero' => 1]);
    }
}
