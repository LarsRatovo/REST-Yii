<?php

namespace app\controllers;

use app\models\User;

class UserController extends \yii\rest\Controller
{

    //fonction d'inscription
    public function actionRegister(){
        $request = \Yii::$app->request;

        //check si c'est un POST
        if($request->isPost){
            $user = new User(['scenario'=> User::SCENARIO_ACTION]);
            //Récupération des données
            $user->load(\Yii::$app->getRequest()->getBodyParams(),'');
            //Validation
            if($user->validate()){
                $user->password_hash = md5($user->password_hash);
                //Sauvegarde vers la base de donnée
                if($user->save()){
                    \Yii::$app->response->statusCode = 201;
                    return ["message"=>"Register done"];
                }
                return ['errors' => $user->errors];
            }
        }
        \Yii::$app->response->statusCode = 400;
        return ;
    }

    public function actionLogin(){
        $request = \Yii::$app->request;

        if($request->isPost){
            $user = new User(['scenario'=> User::SCENARIO_ACTION]);
            if($user->validate()){
                $user->load(\Yii::$app->getRequest()->getBodyParams(),'');
                $logged = User::login($user);
                if($logged){
                    //Générer un nouveau token pour plus de sécurité
                    $logged->auth_token = \Yii::$app->security->generateRandomString();
                    
                    //Modifier la base de donnée
                    $logged->update();

                    //Ne pas afficher le mot de passe
                    unset($logged->password_hash);
                    return $logged;
                }
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
