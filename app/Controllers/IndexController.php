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
        $limitMonth = 15;
        $fiterFunction = function (array $job) use ($limitMonth){
            return $job['month'] >= $limitMonth;
        };

        $jobs = array_filter($jobs->toArray(), $fiterFunction);

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