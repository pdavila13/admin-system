<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    $files = Storage::files('ruta_de_tu_carpeta_compartida');

    return view('files.index', compact('files'));
}
