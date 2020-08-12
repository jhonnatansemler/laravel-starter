<?php
namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Serie as Serie;
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

    public function store(SeriesFormRequest $request){

        $nome = $request->nome;

        $serie = Serie::create($request->all());

        $request->session()->flash('mensagem', "Série #{$serie->id} ($serie->nome) criada com sucesso");

        return redirect()->route('series_home');

        // if($serie instanceof Serie){
        //     echo 'Série com id '.$serie->id.' criada com sucesso: '.$serie->nome;
        // }

        // $serie = new Serie();

        // $serie->nome = $nome;

        // if($serie->save()){
        //     echo "Salvo com sucesso";
        // }
    }

    public function destroy(Request $request){
        Serie::destroy($request->id);
        $request->session()->flash('mensagem', "Série removida com sucesso");
        return redirect()->route('series_home');
    }


}
?>
