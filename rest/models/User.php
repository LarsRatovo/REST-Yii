<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property string $auth_token
 */
class User extends \yii\db\ActiveRecord
{
    const SCENARIO_ACTION='action';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password_hash'], 'required'],
            [['username', 'password_hash', 'auth_token'], 'string', 'max' => 150],
            [['username'], 'unique'],
            [['auth_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password_hash' => 'Password Hash',
            'auth_token' => 'Auth Token',
        ];
    }
    
    //Scenario pour pouvoir récupérer les données et les valider
    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_ACTION] = ['username','password_hash'];
        return $scenarios;
    }

    //Fonction login pour récupérer l'utilisateur avec l'username et password_hash
    public static function login($user){
        return static::findOne(['username'=>$user->username,'password_hash'=>md5($user->password_hash)]);
    }
}
