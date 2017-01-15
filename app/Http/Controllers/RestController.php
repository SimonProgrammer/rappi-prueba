<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Matriz;

class RestController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function procesarDatos(Request $request)
    {
        $input = $request->all();
        $comandos = explode(PHP_EOL,$request->input('comandos'));
        $matriz = new Matriz($comandos);
        $response = $matriz->procesarComandos();
        return implode(PHP_EOL,$response);
    }
    
}