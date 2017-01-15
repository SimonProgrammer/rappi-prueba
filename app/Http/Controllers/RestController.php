<?php

namespace App\Http\Controllers;

use App\Model\Matrix;
use App\Http\Controllers\Controller;

class RestController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function ProcesarDatos()
    {
        $matrix = new Matrix();
    }
}