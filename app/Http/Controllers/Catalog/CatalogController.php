<?php

namespace App\Http\Controllers\Catalog;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CatalogController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.catalog.index')->only('index','search');
    }

    public function index()
    {
        return view('admin.catalog.index');
    }

    public function search(Request $request)
    {
        // $request->validate([
        //     'ruta' => 'required',
        // ]);

        // $file_name = $request->input('file_name');
        // $latest_version = $request->input('latest_version');
        // $ruta = $request->input('ruta');

        // // Construir la consulta base con columnas específicas
        // $query = DB::connection('catalogoficheros')->table('catalogo' . $ruta)
        //         ->select('fecha', 'file_name', 'ruta', 'ultimo_cambio', 'tamaño');

        // // Añadir condiciones en función de la entrada del usuario
        // if (!empty($file_name)) {
        //     if ($latest_version) {
        //         $query->select(DB::raw('max(fecha) as fecha, file_name, ruta, max(ultimo_cambio) as ultimo_cambio, tamaño'))
        //             ->whereRaw("match(file_name,ruta) against(? in boolean mode)", [$file_name])
        //             ->groupBy('file_name', 'ruta');
        //     } else {
        //         $query->whereRaw("match(file_name,ruta) against(? in boolean mode)", [$file_name]);
        //     }
        // }

        // // Ordenar por nombre de archivo, ruta y fecha
        // $query->orderBy('file_name')
        //     ->orderBy('ruta')
        //     ->orderBy('fecha');

        $validatedData = $request->validate([
            'ruta' => 'required',
        ]);
    
        $file_name = $request->input('file_name');
        $latest_version = $request->input('latest_version');
        $ruta = $validatedData['ruta'];
    
        // Construir la consulta base
        $query = DB::connection('catalogoficheros')->table('catalogo' . $ruta)
                    ->select('fecha', 'file_name', 'ruta', 'ultimo_cambio', 'tamaño');
    
        // Añadir condiciones de búsqueda si se especifica un nombre de archivo
        if (!empty($file_name)) {
            $query->whereRaw("match(file_name,ruta) against(? in boolean mode)", [$file_name]);
    
            // Si se solicita la última versión, ajustar la consulta
            if ($latest_version) {
                $query->select(DB::raw('max(fecha) as fecha, file_name, ruta, max(ultimo_cambio) as ultimo_cambio, tamaño'))
                      ->groupBy('file_name', 'ruta');
            }
        }
    
        // Ordenar la consulta
        $query->orderBy('file_name')
              ->orderBy('ruta')
              ->orderBy('fecha');

        // Obtener resultados (puedes usar paginate() para reducir carga)
        $results = $query->get();

        // Pasar los valores de entrada de vuelta a la vista junto con los resultados
        return view('admin.catalog.index', compact('results', 'file_name', 'latest_version', 'ruta'));
    }
}
