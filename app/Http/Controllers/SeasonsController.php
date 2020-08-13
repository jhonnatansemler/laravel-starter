<?php

namespace App\Http\Controllers;

use App\Serie;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    public function index(int $serieID)
    {
        $serie = Serie::find($serieID);

        $temporadas = $serie->temporadas;

        return view('temporadas.index', compact('temporadas', 'serie'));
    }
}
