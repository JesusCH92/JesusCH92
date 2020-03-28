<?php

namespace App\Controllers;

use App\Models\Job;
use Respect\Validation\Validator as v;

class JobsController extends BaseController{
    public function getAddjobAction($request){
        $responseMessage=null;
        // var_dump($request>getMethod());
        // var_dump((string)$request->getBody());
        //*var_dump($request->getParsedBody());
//*array(2) { ["title"]=> string(10) "Python Dev" ["description"]=> string(10) "I love py!" } 
        if($request->getMethod() == 'POST'){
            $postData = $request->getParsedBody();
            $jobValidator = v::key('title', v::stringType()->notEmpty())
                  ->key('description', v::stringType()->notEmpty());
            try{
                $jobValidator->assert($postData);
                $postData = $request->getParsedBody();
                // !$_FILE = sirve para obtener los archivos que vamos a subir
                $files = $request->getUploadedFiles();
                // $logo = $files['logo'];
                var_dump($files);
                // if($logo->getError() == UPLOAD_ERR_OK){
                //     $fileName = $logo->getClientFilename();
                //     $logo->moveTo("uploads/$fileName");
                // }
                // $job = new Job();
                // $job->title = $postData['title'];
                // $job->description = $postData['description'];
                // $job->save();
                // $responseMessage = 'Saved!';
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