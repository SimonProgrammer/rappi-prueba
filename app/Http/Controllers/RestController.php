<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Application\ApplicationMatriz;

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
        $application_matriz = new ApplicationMatriz();
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
        $response =  $application_matriz->sumaCubo($comandos);
        return $response;
    }
    
}