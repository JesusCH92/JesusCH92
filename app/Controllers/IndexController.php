<?php

namespace App\Controllers;

use App\Models\{Job, Project};

class IndexController extends BaseController{
    public function indexAction(){
        $jobs = Job::all();     // *  ddbb
        $project1 = new Project('Project 1', 'Description 1');
        $project1-> months = 12;
        $projects = [
            $project1
        ];
        $limitMonth = 15;
        $fiterFunction = function (array $job) use ($limitMonth){
            return $job['months'] >= $limitMonth;
        };

        $jobs = array_filter($jobs->toArray(), $fiterFunction);

        $lastName = "CH";
        $name = "Jesús $lastName";

        return $this->renderHTML('index.twig', [
            'name' => $name,
            'jobs' => $jobs,
        ]);
    }
}