<?php
namespace App\Models;
/*
* tampoco hace falta indicar la clase padre, ya que composer lo hará
require_once 'BaseElement.php'; // !Incluimos la clase padre
*/
use Illuminate\Database\Eloquent\Model;


class Job extends Model{
    protected $table = 'jobs';  // ? Nombre de nuestra tabla en nuestra bbdd


    public function getDurationAsString() {
    /*
    !Con el "$this", estamos accediendo a la propiedad del padre
    */
        $years = (floor($this->months /12) == 0 ? '' : strval(floor($this->months /12)) . " years ");
        $extraMonths = ($this->months % 12 == 0 ? '' : strval($this->months % 12) . " months");
        return "Job duration $years$extraMonths";
    }

}