<?php

namespace App\Http\Models;

class Matriz
{
	private $cubo;
	public function __construct()
	{
         $this->cubo = array();
	}
    public function getPos($x,$y,$z){
        return $this->cubo[$x][$y][$z];
    }
    public function setPos($x,$y,$z,$item){
        $this->cubo[$x][$y][$z] = $item;
    }
    public function setMatriz($cubo){
        $this->cubo = $cubo;
    }
    public function isEmpty(){
        return empty($this->cubo);
    }
}