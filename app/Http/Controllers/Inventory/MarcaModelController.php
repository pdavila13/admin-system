<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Models\Inventory\Tipo;
use App\Models\Inventory\Marca;
use App\Models\Inventory\Modelo;
use App\Http\Controllers\Controller;

class MarcaModelController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.marca-model.index')->only('index','store','getMarcas','getModelos');
    }

    public function index()
    {
        $tipos = Tipo::where('id', 9)->orderBy('def', 'ASC')->get();
        return view('admin.inventory.marca_model', compact('tipos'));
    }

    public function getMarcas(Request $request)
    {
        $marcas = Marca::where('tipo', $request->tipo_id)->orderBy('DEF','ASC')->get(['ID', 'DEF']);
        return response()->json($marcas);
    }

    public function getModelos(Request $request)
    {
        $modelos = Modelo::where('marca', $request->marca_id)->orderBy('def','ASC')->get(['id', 'def']);
        return response()->json($modelos);
    }

    public function store(Request $request)
    {
        // Create the messages
        $mensajeMarca = '';
        $mensajeModelo = '';

        // Verify if the brand is new
        if ($request->marca == '-2') {
            $marca = Marca::create([
                'DEF' => $request->description,
                'tipo' => $request->tipo
            ]);
            $mensajeMarca = 'messages.trademark_created';
        } else {
            $marca = Marca::find($request->marca);
        }

        // Verify if the model is new
        if ($request->modelo == '-2') {
            $modelo = Modelo::create([
                'def' => $request->description,
                'marca' => $marca->ID,
                'tipo' => $request->tipo
            ]);
            $mensajeModelo = 'messages.model_created';
        }

        if ($marca && $mensajeMarca && !$mensajeModelo) {
            return redirect()->route('admin.marca-model.index')->with('success', $mensajeMarca);
        } elseif ($modelo && $mensajeModelo) {
            return redirect()->route('admin.marca-model.index')->with('success', $mensajeModelo);
        } else {
            return redirect()->route('admin.marca-model.index')->with('error', 'messages.error_no_save');
        }
    }
}
