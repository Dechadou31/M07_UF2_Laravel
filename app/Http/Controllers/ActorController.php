<?php
namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{
    public function listActors()
    {
        $actors = DB::table('actors')->get();
        $title = "Listado de Actores";	
        return view('actors.list', ["actors" => $actors, "title" => $title]);
    }

    // Método para listar actores por década
    public function listActorsByDecade($year = null)
    {
        // Lista de décadas válidas
        $validYears = [1980, 1990, 2000, 2010, 2020];

        $startYear = $year;+
        $endYear = $year + 9;
        
        $startDate = "{$startYear}-01-01";
        $endDate = "{$endYear}-12-31";

        $actors = DB::table('actors')
                    ->whereBetween('birthdate', [$startDate, $endDate])
                    ->get();

        $title = "Actores nacidos en la década de los " . $year . "s";

        return view('actors.listByDecade', compact('actors', 'title', 'year'));
    }
    public function countActors()
{
    $actorCount = DB::table('actors')->count();

    return view('actors.count', compact('actorCount'));
}

public function destroy($id)
{
    $actors = DB::find($id);

    if (!$actors) {
        return response()->json([
            'action' => 'delete',
            'status' => false,
            'message' => 'Actor no encontrado'
        ], 404);
    }

    $deleted = $actors->delete();

    return response()->json([
        'action' => 'delete',
        'status' => $deleted
    ]);
}
}
