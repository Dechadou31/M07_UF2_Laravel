<?php
// filepath: /c:/xampp/htdocs/M07/M07_Pr1_Laravel/M07_UF2_Laravel/app/Http/Controllers/FilmController.php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Film;

class FilmController extends Controller
{
    public static function readFilms(): array {

    $filmsFromDB = Film::select('name', 'year', 'genre', 'country', 'duration', 'img_url')->get()->toArray();

    $filmsFromJson = [];
    if (Storage::exists('public/films.json')) {
        $json = Storage::get('public/films.json');
        $filmsFromJson = json_decode($json, true) ?? [];
    }

    return array_merge($filmsFromDB, $filmsFromJson);
    }

    public function listOldFilms($year = null)
    {        
        $old_films = [];
        if (is_null($year))
            $year = 2000;
    
        $title = "Listado de Pelis Antiguas (Antes de $year)";    
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] < $year)
                $old_films[] = $film;
        }
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }

    public function listNewFilms($year = null)
    {
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Desde $year)";    
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }

    public function listFilmsByYear($year = null)
    {
        $filmsByYear = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis del Año $year";    
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] == $year)
                $filmsByYear[] = $film;
        }
        return view('films.list', ["films" => $filmsByYear, "title" => $title]);
    }

    public function listFilmsByGenre($genre)
    {
        $filmsByGenre = [];
        $title = "Listado de Pelis del Género $genre";    
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if (strcasecmp($film['genre'], $genre) == 0)
                $filmsByGenre[] = $film;
        }
        return view('films.list', ["films" => $filmsByGenre, "title" => $title]);
    }

    public function sortFilms()
    {
        $films = FilmController::readFilms();
        usort($films, function($a, $b) {
            return $b['year'] - $a['year'];
        });

        $title = "Listado de todas las pelis ordenadas por año (de más reciente a más antigua)";
        return view('films.list', ["films" => $films, "title" => $title]);
    }

    public function countFilms()
    {
        $films = FilmController::readFilms();
        $count = count($films);

        return view('films.counter', ["count" => $count]);
    }

    public function createFilm(Request $request)
{
    //         // Leer películas actuales
    //         $films = self::readFilms();

    //         // Verificar si el nombre ya existe
    //         if ($this->isFilm($films, $request->name)) {
    //             return redirect('/')
    //                 ->with('error', 'Esta película ya está registrada.');
    //         }
    // // Agrega la nueva película
    // $newFilm = [
    //     'name' => $request->name,
    //     'year' => $request->year,
    //     'genre' => $request->genre,
    //     'country' => $request->country,
    //     'duration' => $request->duration,
    //     'img_url' => $request->img_url,
    // ];
    
    // // Guarda la lista actualizada de películas
    // $films = Storage::json('/public/films.json');
    // if(FilmController::isFilm($films, $newFilm['name'])){
    //     return view('welcome' , ["error" => "Ya existe esta peli"]);
    // }
    // array_push($films, $newFilm);
    // Storage::put('/public/films.json', json_encode($films));
    
    // $films = FilmController::readFilms();
    // return redirect('/filmout/films')->with('success', 'Película registrada con éxito.');

    $films = self::readFilms();

    if ($this->isFilm($films, $request->name)) {
        return redirect('/')->with('error', 'Esta película ya está registrada.');
    }

    $newFilm = [
        'name' => $request->name,
        'year' => $request->year,
        'genre' => $request->genre,
        'country' => $request->country,
        'duration' => $request->duration,
        'img_url' => $request->img_url,
        'created_at' => now(),
        'updated_at' => now(),
    ];

    $flag = env('flag', 'default');
    if ($flag == 'database') {
        
        Film::create($newFilm);
    } elseif ($flag == 'json') {
        $filmsFromJson = Storage::exists('public/films.json') ? json_decode(Storage::get('public/films.json'), true) : [];
        array_push($filmsFromJson, $newFilm);
        Storage::put('public/films.json', json_encode($filmsFromJson, JSON_PRETTY_PRINT));
    } else {
        return redirect('/')->with('error', 'Configuración de almacenamiento inválida.');
    }

    return redirect('/filmout/films')->with('success', 'Película registrada con éxito.');
    
}
public function listFilms($year = null, $genre = null)
    {
        $films_filtered = [];
 
        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();
 
        //if year and genre are null
        if (is_null($year) && is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);
 
        //list based on year or genre informed
        foreach ($films as $film) {
            if ((!is_null($year) && is_null($genre)) && $film['year'] == $year){
                $title = "Listado de todas las pelis filtrado x año";
                $films_filtered[] = $film;
            }else if((is_null($year) && !is_null($genre)) && strtolower($film['genre']) == strtolower($genre)){
                $title = "Listado de todas las pelis filtrado x categoria";
                $films_filtered[] = $film;
            }else if(!is_null($year) && !is_null($genre) && strtolower($film['genre']) == strtolower($genre) && $film['year'] == $year){
                $title = "Listado de todas las pelis filtrado x categoria y año";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }
    function isFilm ($films, $name){
        foreach ($films as $film) {
            if ($film['name'] == $name) {
                return true;
            }
        }
    }
}