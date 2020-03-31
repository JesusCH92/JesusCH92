<?php


namespace App\Services;


use App\Models\Job;

class JobService
{
    public function deleteJob($id){
//        $job = Job::find($id);
//        if (!$job) {
//            throw new \Exception('Job not found');
//        }
        var_dump($this);
        $job = Job::findOrFail($id); // si no encuentra el objeto lanzara el error, es lo mismo que el comentario de arriba
        $job->delete();
    }
}