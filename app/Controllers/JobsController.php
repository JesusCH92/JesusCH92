<?php

namespace App\Controllers;

use App\Models\Job;
use Respect\Validation\Validator as v;

class JobsController extends BaseController{
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

        // include '../views/addJob.php';
        return $this->renderHTML('addJob.twig',[
            'responseMessage' => $responseMessage 
        ]);
    }
}