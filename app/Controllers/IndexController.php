<?php

namespace App\Controllers;

use App\Models\{Job, Project};

class IndexController extends BaseController{
    public function indexAction(){
        $jobs = Job::all();     // *  ddbb
        $project1 = new Project('Project 1', 'Description 1');
        $project1-> months = 16;
        $projects = [
            $project1
        ];

        $lastName = "CH";
        $name = "Jesús $lastName";
        $limitMonths = 2000;

        // include '../views/index.php';
        return $this->renderHTML('index.twig', [
            'name' => $name,
            'jobs' => $jobs,
        ]);
    }
}