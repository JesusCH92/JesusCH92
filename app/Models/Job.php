<?php
namespace App\Models;

use App\Traits\HasDefaultImage;
use Illuminate\Database\Eloquent\Model;


class Job extends Model{
    use HasDefaultImage;
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