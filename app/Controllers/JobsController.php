<?php

namespace App\Controllers;

use App\Models\Job;
use App\Services\JobService;
use Respect\Validation\Validator as v;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;

class JobsController extends BaseController{
    private $jobService;

    public function __construct(JobService $jobService)
    {
        parent::__construct();
        $this->jobService = $jobService;
    }

    public function indexAction() {
        $jobs  = Job::withTrashed()->get();
        return $this->renderHTML('Jobs/index.twig', compact('jobs'));
    }

    public function deleteAction (ServerRequest $request) {
        $params = $request->getQueryParams();
        $this->jobService->deleteJob($params['id']);

        return new RedirectResponse('/primer-proyecto-php/jobs');
    }

    public function getAddjobAction($request){
        $responseMessage=null;
        if($request->getMethod() == 'POST'){
            $postData = $request->getParsedBody();
            $jobValidator = v::key('title', v::stringType()->notEmpty())
                  ->key('description', v::stringType()->notEmpty());
            try{
                $jobValidator->assert($postData);
                $postData = $request->getParsedBody();
                // !$_FILE = sirve para obtener los archivos que vamos a subir
                $files = $request->getUploadedFiles();
                $logo = $files['logo'];
                $filePath = "";
                var_dump($files);
                if($logo->getError() == UPLOAD_ERR_OK){
                    $fileName = $logo->getClientFilename();
                    $filePath = "uploads/$fileName";
                    $logo->moveTo($filePath);
                }
                $job = new Job();
                $job->title = $postData['title'];
                $job->description = $postData['description'];
                $job->image = $filePath;
                $job->save();
                $responseMessage = 'Saved!';
            } catch(\Exception $e){
                $responseMessage = $e->getMessage();
            }
            

        }

        return $this->renderHTML('addJob.twig',[
            'responseMessage' => $responseMessage 
        ]);
    }
}