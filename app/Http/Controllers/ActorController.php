<?php
namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{
    public function listActors()
    {
        $actors = Actor::all();
        $title = "Listado de Actores";	
        return view('actors.list', ["actors" => $actors, "title" => $title]);
    }

    public function listActorsByDecade($year = null)
    {
        // Lista de décadas válidas
        $validYears = [1980, 1990, 2000, 2010, 2020];
        if (!in_array($year, $validYears)) {
            return redirect()->back()->with('error', 'Década no válida');
        }
    
        $startYear = $year;
        $endYear = $year + 9;
    
        $startDate = "{$startYear}-01-01";
        $endDate = "{$endYear}-12-31";
    
        
        $actors = Actor::whereBetween('birthdate', [$startDate, $endDate])->get();
    
        $title = "Actores nacidos en la década de los " . $year . "s";
    
        return view('actors.listByDecade', compact('actors', 'title', 'year'));
    }
    public function countActors()
{
    $actorCount = Actor::count();

    return view('actors.count', compact('actorCount'));
}

public function destroy($id)
{
    $actors = Actor::find($id);

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
