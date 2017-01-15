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
                $params = explode(' ',trim($comando));
                $this->matriz[$params[1]][$params[2]][$params[3]] = $params[4];
            }
            else if(stripos(trim($comando),"QUERY") !== false){
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
    public function productoCartesiano($first,$second){
        $product = array();
        foreach ($first as $key => $a) {
            foreach ($second as $key2 => $b) {
                $product[] = array_merge((array)$a, (array)$b);
            }
        }
        return $product;
    }

	
}