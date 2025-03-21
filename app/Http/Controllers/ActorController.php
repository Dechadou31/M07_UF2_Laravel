<?php
namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{
    // Método para obtener los actores y pasarlos a la vista
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

        // Definir el rango de fechas de la década seleccionada
        $startYear = $year;+
        $endYear = $year + 9;
        
        // Crear las fechas de inicio y fin para el rango
        $startDate = "{$startYear}-01-01";
        $endDate = "{$endYear}-12-31";

        // Obtener actores nacidos dentro de la década seleccionada
        $actors = DB::table('actors')
                    ->whereBetween('birthdate', [$startDate, $endDate])
                    ->get();

        // Definir el título para la vista
        $title = "Actores nacidos en la década de los " . $year . "s";

        // Pasar los actores y el título a la vista
        return view('actors.listByDecade', compact('actors', 'title', 'year'));
    }
    public function countActors()
{
    // Contar el total de actores en la base de datos
    $actorCount = DB::table('actors')->count();

    // Pasar el número de actores a la vista
    return view('actors.count', compact('actorCount'));
}


}
