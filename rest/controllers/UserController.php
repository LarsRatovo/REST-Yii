<?php

namespace app\controllers;

use app\models\User;

class UserController extends \yii\rest\Controller
{
    public function actionRegister(){
        $request = \Yii::$app->request;
        if($request->isPost){
            $user = new User(['scenario'=> User::SCENARIO_ACTION]);
            $user->load(\Yii::$app->getRequest()->getBodyParams(),'');
            $user->password_hash = md5($user->password_hash);
            if($user->save()){
                \Yii::$app->response->statusCode = 201;
                return ["message"=>"Register done"];
            }
            return ['errors' => $user->errors];
        }
        \Yii::$app->response->statusCode = 400;
        return ;
    }

    public function actionLogin(){
        $request = \Yii::$app->request;
        if($request->isPost){
            $user = new User(['scenario'=> User::SCENARIO_ACTION]);
            $user->load(\Yii::$app->getRequest()->getBodyParams(),'');
            $logged = User::login($user);
            if($logged){
                $logged->auth_token = \Yii::$app->security->generateRandomString();
                $logged->update();
                unset($logged->password_hash);
                return $logged;
            }
            \Yii::$app->response->statusCode = 401;
            return [
                'errors'=> 'No user with the given credential found '
            ];
        }
        \Yii::$app->response->statusCode = 400;
        return ;
    }

}
