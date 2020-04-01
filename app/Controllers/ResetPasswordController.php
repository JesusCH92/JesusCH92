<?php

namespace App\Controllers;

use App\Models\{User};
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Response\RedirectResponse;

class ResetPasswordController extends BaseController{
    public function changePassword(){
        return $this->renderHTML('changePassword.twig');
    }

    public function resetPassword(ServerRequest $request){

        $postData = $request->getParsedBody();

        if (!$postData['password']) {
            return;
        }

        $user = User::where('id', $_SESSION['userId'])->first();
        $user->password = password_hash($postData['password'], PASSWORD_DEFAULT);
        $user->save();

        return new RedirectResponse('/primer-proyecto-php/admin');
    }
}