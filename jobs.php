<?php
/*
* Con composer autoload ya no hace falta los require
require 'app/Models/Job.php';
require 'app/Models/Project.php';
require_once 'app/Models/Printable.php';
* solo hace falta indicar donde se encuentra el autoload
*/
/*
! Una forma de especificar USE:
* use App\Models\Job;
* use App\Models\Project;
* use App\Models\Printable;
*/
use App\Models\{Job, Project};


  
  

//?>