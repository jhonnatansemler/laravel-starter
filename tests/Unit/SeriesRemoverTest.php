<?php

namespace Tests\Unit;

use App\Services\SeriesCreator;
use App\Services\SeriesRemover;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeriesRemoverTest extends TestCase
{

    use RefreshDatabase;

    private $serie;
    private $serieName = 'Série de teste';

    protected function setUp() : void
    {
        parent::setUp();
        $serieCreator = new SeriesCreator();
        $this->serie = $serieCreator->createSerie($this->serieName, 1, 1);
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testRemoveSerie()
    {
        $this->assertDatabaseHas('series', ['id'=>$this->serie->id]);

        $serieRemover = new SeriesRemover();
        $removedSerieName = $serieRemover->removeSerie($this->serie->id);

        $this->assertIsString($removedSerieName);
        $this->assertEquals($this->serieName, $removedSerieName);
        $this->assertDatabaseMissing('series', ['id'=>$this->serie->id]);
    }
}
