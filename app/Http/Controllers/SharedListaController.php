<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use Illuminate\Http\Request;

class SharedListaController extends Controller
{
    public function show(Request $request, string $code) {
        return Lista::where('code', '=', $code)->first();
    }
}
