<?php

namespace App\Http\Models;

class Matriz
{
	private $matriz;
    private $comandos;
    private $tam;
	public function __construct($comandos)
	{
         $this->matriz = array();
         $this->comandos = $comandos;
         $this->tam = 0;
	}
    public function procesarComandos(){
        if(!self::validarComandos()){
            return array();
        }
        $response = array();
        foreach ($this->comandos as $key => $comando) {
            if(count(explode(" ",trim($comando))) == 2){
               $params = explode(" ",trim($comando));
               if(is_numeric($params[0])){
                  $this->tam = (int)$params[0];
                  $this->matriz = self::obtenerMatriz();
               }
            }
            else if(stripos(trim($comando),"UPDATE") !== false){
                if (!empty($this->matriz)) {
                   $params = explode(' ',trim($comando));
                   $this->matriz[$params[1]][$params[2]][$params[3]] = $params[4];
                }
            }
            else if(stripos(trim($comando),"QUERY") !== false){
                if(!empty($this->matriz)){
                    $params = explode(' ',trim($comando));
                    $x = range((int)$params[1],(int)$params[4]);
                    $y = range((int)$params[2],(int)$params[5]);
                    $z = range((int)$params[3],(int)$params[6]);
                    $combinacion = self::productoCartesiano($x,$y);
                    $combinacion = self::productoCartesiano($combinacion,$z);
                    $sum = 0;
                    foreach ($combinacion as $punto => $coordenada) {
                        $x = $coordenada["0"]; 
                        $y = $coordenada["1"]; 
                        $z = $coordenada["2"]; 
                        $sum+=$this->matriz[$x][$y][$z];
                    }
                    array_push($response,$sum);
                }    
            }
        }
        return $response;
    }
    public function obtenerMatriz(){
        $tam = $this->tam;
        $crearmatriz = function($arg)use($tam){
            return (is_array($arg) ? array_fill(1,$tam,array_fill(1,$tam,0)) :  array_fill(1,$tam,0));
        };
        $matriz = array_fill(1,$tam,0); // array unidimensional
        $matriz = array_map($crearmatriz,$matriz); // array bidimensional
        $matriz = array_map($crearmatriz,$matriz); // array tridimensional
        return $matriz;
    }
    public function productoCartesiano($first,$second){//Para sacar todas las posiciones
        $product = array();
        foreach ($first as $key => $a) {
            foreach ($second as $key2 => $b) {
                $product[] = array_merge((array)$a, (array)$b);
            }
        }
        return $product;
    }
    public function validarComandos(){
        $valido = true;
        //Validacion T
        $casos = 0; // numero de casos a ejecutar
        $tam = 0; // tamaño matriz
        $acum_m = 0; //acumulador M para comparar con el numero de comandos
        $acum_casos = 0; //acumulador casos
        $acum_comandos = 0; // acumulador de comandos

        foreach ($this->comandos as $key => $comando){
            if($valido){
                if($key == 0){
                    $t = (is_numeric(trim($comando)) ? (int)trim($comando) : 0);
                    if($t >= 1 && $t <= 50){
                        $casos = $t;
                    }
                    else{
                        $valido = false;
                    }
                }
                else{
                    if(count(explode(" ",trim($comando))) == 2){//linea N M
                        $linea_nm = explode(" ",trim($comando));
                        $n = (is_numeric(trim($linea_nm[0])) ? (int)trim($linea_nm[0]) : 0);
                        $m = (is_numeric(trim($linea_nm[1])) ? (int)trim($linea_nm[1]) : 0);
                        if(($n >= 1 && $n <= 100) && ($m >= 1 && $m <= 100)){
                            $tam = $n;
                            $acum_m += $m;
                            $acum_casos++;
                        }
                        else{
                            $valido = false;
                        }

                        if(($key+1) < count($this->comandos)){
                            if(!(stripos(trim($this->comandos[($key+1)]),"QUERY") !== false || stripos(trim($this->comandos[($key+1)]),"UPDATE") !== false)) {
                                $valido = false;
                            }
                        }
                    }
                    else if(stripos(trim($comando),"UPDATE") !== false){ // Linea UPDATE
                        $linea_update = explode(" ",trim($comando));
                        if (count($linea_update) == 5) {
                            $x = (is_numeric(trim($linea_update[1])) ? (int)trim($linea_update[1]) : 0);
                            $y = (is_numeric(trim($linea_update[2])) ? (int)trim($linea_update[2]) : 0);
                            $z = (is_numeric(trim($linea_update[3])) ? (int)trim($linea_update[3]) : 0);
                            $w = (is_numeric(trim($linea_update[4])) ? (int)trim($linea_update[4]) : 0);
                            if(($x >= 1 && $x <= $tam) && ($y >= 1 && $y <= $tam) && ($z >= 1 && $z <= $tam)&& ($w >= pow(-10,9) && $w <= pow(10,9))){
                                $acum_comandos++;
                            }
                            else{
                                $valido = false;
                            }
                        }
                        else{
                            $valido = false;
                        }
                    }
                    else if(stripos(trim($comando),"QUERY") !== false){ // Linea UPDATE
                        $linea_query = explode(" ",trim($comando));
                        if(count($linea_query) == 7){
                            $x1 = (is_numeric(trim($linea_query[1])) ? (int)trim($linea_query[1]) : 0);
                            $y1 = (is_numeric(trim($linea_query[2])) ? (int)trim($linea_query[2]) : 0);
                            $z1 = (is_numeric(trim($linea_query[3])) ? (int)trim($linea_query[3]) : 0);
                            $x2 = (is_numeric(trim($linea_query[4])) ? (int)trim($linea_query[4]) : 0);
                            $y2 = (is_numeric(trim($linea_query[5])) ? (int)trim($linea_query[5]) : 0);
                            $z2 = (is_numeric(trim($linea_query[6])) ? (int)trim($linea_query[6]) : 0);
                            $valx = (($x1 >= 1 && $x1 <= $x2) && ($x2 >= 1 && $x2 <= $tam));
                            $valy = (($y1 >= 1 && $y1 <= $y2) && ($y2 >= 1 && $y2 <= $tam));
                            $valz = (($z1 >= 1 && $z1 <= $z2) && ($z2 >= 1 && $z2 <= $tam));
                            if($valx && $valy && $valz){
                                $acum_comandos++;
                            }
                            else{
                                $valido = false;
                            }
                        }
                        else{
                            $valido = false;
                        }
                    }
                    else{
                        $valido = false;
                    }
                }
            }
        }
        if(!(($acum_comandos == $acum_m) && ($casos == $acum_casos))){
            $valido = false;
        }

        return $valido;
    }

	
}