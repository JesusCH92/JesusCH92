<?php
namespace App\Controllers;
use App\Models\User;
use Respect\Validation\Validator as v;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;

class AuthController extends BaseController{
    public function getLogin(){
        return $this->renderHTML('login.twig');
    }
    public function postLogin(ServerRequest $request){
        $postData = $request->getParsedBody();
        $responseMessage = null;
        // * Validation 
        $user =User::where('email', $postData['email'])->first();
        if($user){
            if(password_verify($postData['password'], $user->password)){
                // ! echo 'yeap password';
                $_SESSION['userId']=$user->id;
                // var_dump($_SESSION['userId']);exit;
                return new RedirectResponse('/primer-proyecto-php/admin');
            }else{
                $responseMessage = 'Bad credential';
            }
        }else{
            $responseMessage = 'Bad credential';
        }
        return $this->renderHTML('login.twig',[
            'responseMessage' => $responseMessage
        ]);
    }
    public function getLogout(){
        unset($_SESSION['userId']);     // !destruimos la sesion
        return new RedirectResponse('/primer-proyecto-php/login');

    }

}