<?php

namespace App\Http\Controllers\Catalog;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CatalogController extends Controller
{
    public function index()
    {
        return view('admin.catalog.index');
    }

    public function search(Request $request)
    {
        $file_name = $request->input('file_name');
        $latest_version = $request->input('latest_version');
        $ruta = $request->input('ruta');

        // Construir la consulta base con columnas específicas
        $query = DB::connection('catalogoficheros')->table('catalogo' . $ruta)
                ->select('fecha', 'file_name', 'ruta', 'ultimo_cambio', 'tamaño');

        // Añadir condiciones en función de la entrada del usuario
        if (!empty($file_name)) {
            if ($latest_version) {
                $query->select(DB::raw('max(fecha) as fecha, file_name, ruta, max(ultimo_cambio) as ultimo_cambio, tamaño'))
                    ->whereRaw("match(file_name,ruta) against(? in boolean mode)", [$file_name])
                    ->groupBy('file_name', 'ruta');
            } else {
                $query->whereRaw("match(file_name,ruta) against(? in boolean mode)", [$file_name]);
            }
        }

        // Ordenar por nombre de archivo, ruta y fecha
        $query->orderBy('file_name')
            ->orderBy('ruta')
            ->orderBy('fecha');

        // Obtener resultados (puedes usar paginate() para reducir carga)
        $results = $query->get();

        // Pasar los valores de entrada de vuelta a la vista junto con los resultados
        return view('admin.catalog.index', compact('results'))
            ->with('file_name', $file_name)
            ->with('latest_version', $latest_version)
            ->with('ruta', $ruta);
    }
}
