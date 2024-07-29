<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videogame;
use App\Models\Category;
use App\Http\Requests\StoreVideogame;
use App\Mail\VideogameMail;
use Illuminate\Support\Facades\Mail;

class GamesController extends Controller
{
    //
    public function index()
    {
        // $videogames = array("Fifa 23","NBA 22","Mario Kart","Super Mario","Dead by Daylihgt","Fortnite","Warzone");
        $videogames = videogame::orderBy("id", "desc")->get();
        return view("index", ['games' => $videogames]);
    }

    public function create()
    {
        $categorias = Category::all();
        return view("create", ["categorias" => $categorias]);
    }
    function help($name, $categoria = null)
    {
        $date = Now();
        return view("show", ["nameVideogame" => $name, "categoryGame" => $categoria, "fecha" => $date]);
    }
    public function updateVideogame(StoreVideogame $request)
    {
        // $request->validate([
        //     'name' => 'required|min:5|max:10'
        // ]);
        $game = Videogame::find($request->game_id);
        $game->name = $request->name;
        $game->category_id = $request->category_id;
        $game->active = 1;
        $game->save();
        return redirect()->route("games");
    }
    public function view($game_id)
    {
        $game = Videogame::find($game_id);
        $categorias = Category::all();
        return view("update", ["categorias" => $categorias, 'game' => $game]);
    }

    public function storeVideogame(StoreVideogame $request)
    {
        // return $request->all();
        // $request->validate([
        //     'name' => 'required|min:5|max:10'
        // ]);

        // $game = new Videogame;
        // $game->name = $request->name;
        // $game->category_id = $request->category_id;
        // $game->active = 1;
        // $game->save();

        Videogame::create( $request->all() );
        foreach (['floresguzmanalan@gmail.com'] as $recipient) {
            Mail::to($recipient)->send(new VideogameMail());
        }
        return redirect()->route("games");
    }

    public function delete($game_id){
        $game = Videogame::find($game_id);
        $game->delete();
        return redirect()->route("games");
    }
}
