<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $comandos = array();
        if(isset($input["comandos"])){
            $comandos = explode(PHP_EOL,$request->input('comandos'));
        }
        else if(isset($input["archivo"])){
            $path = $request->file('archivo')->store('files');
            $contents = Storage::get($path);
            $comandos = explode(PHP_EOL,$contents);
        }
        
        $matriz = new Matriz($comandos);
        $response = $matriz->procesarComandos();
        return (count($response) == 0 ? 'Comandos Invalidos' : implode(PHP_EOL,$response));
    }
    
}