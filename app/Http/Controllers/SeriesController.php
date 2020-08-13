<?php
namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Serie as Serie;
use App\Services\SeriesCreator;
use App\Services\SeriesRemover;
use Illuminate\Http\Request;

class SeriesController extends Controller{

    public function index(Request $request){

        $series = Serie::query()->orderBy('nome')->get();

        $mensagem = $request->session()->get("mensagem");

        return view('series.index', compact('series', 'mensagem'));
    }

    public function create(Request $request){

        return view('series.create');
    }

    public function store(SeriesFormRequest $request, SeriesCreator $creator){

        $serie = $creator->createSerie(
            $request->nome,
            $request->temporadas,
            $request->episodios);

        $request->session()->flash('mensagem', "Série #{$serie->id} ($serie->nome) criada com sucesso");

        return redirect()->route('series_home');

    }

    public function destroy(Request $request, SeriesRemover $remover){

        $nomeSerie = $remover->removeSerie($request->id);

        $request->session()->flash('mensagem', "Série $nomeSerie removida com sucesso");
        return redirect()->route('series_home');
    }

    public function editName(int $id, Request $request)
    {
        $novoNome = $request->name;
        $serie = Serie::find($id);
        $serie->nome = $novoNome;
        $serie->save();
    }


}
?>
