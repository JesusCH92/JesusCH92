<?php
namespace App\Models;

require_once 'Printable.php';   // !Necesitamos hacer el require para buscar la interfaz
// * Si implementamos a un padre, se hereda a la clase hija

class BaseElement implements Printable{
    protected $title;   // ! es privada y solo pueden acceder a ella las clases hijas
    public $description;
    public $visible = true;
    public $months;
    
    public function __construct($titulo, $description)
    {
        $this->setTitle($titulo);
        $this->description = $description;
    }

    public function setTitle($t){
        if($t == ''){
            $this->title = "N/A";
        }else{
            $this->title = $t;
        }
    }

    public function getTitle(){
        return $this->title;
    }
    
    public function getDurationAsString() {
        $years = (floor($this->months /12) == 0 ? '' : strval(floor($this->months /12)) . " years ");
        $extraMonths = ($this->months % 12 == 0 ? '' : strval($this->months % 12) . " months");
        return "$years$extraMonths";
    }

    public function getDescription(){
        return $this->description;
    }
}