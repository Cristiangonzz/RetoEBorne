<?php

// namespace app\models;
// use yii\base\NotSupportedException;
// use yii\db\ActiveRecord;
// use yii\helpers\Security;
// use yii\web\IdentityInterface;
// use yii\helpers\Url;


// class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
// {
//     public $id;
//     public $username;
//     public $password;
//     public $authKey;
//     public $accessToken;

//     public static function tableName()
//     {
//         return 'usuario';
//     }
//     public function rules()
//     {
//         return [
//             [['name', 'email','password'], 'required'],
//             [['available', 'admin'], 'integer'],
//             [['id'], 'string', 'max' => 100],
//             [['name', 'email', 'password'], 'string', 'max' => 255],
//             [['id'], 'unique'],
//         ];
//     }


//     /**
//      * {@inheritdoc}
//      */
//     public static function findIdentity($id)
//     {
//         return static::findOne($id);
//     }

//     /**
//      * {@inheritdoc}
//      */
//     public static function findIdentityByAccessToken($token, $type = null)
//     {

//         return null;
//     }

//     /**
//      * Finds user by username
//      *
//      * @param string $username
//      * @return static|null
//      */
//     public static function findByUsername($username)
//     {
//         return static::findOne(['email' => $username]);
//     }

//     /**
//      * {@inheritdoc}
//      */
//     public function getId()
//     {
//         return $this->id;
//     }

//     /**
//      * {@inheritdoc}
//      */
//     public function getAuthKey()
//     {
//         return $this->authKey;
//     }

//     /**
//      * {@inheritdoc}
//      */
//     public function validateAuthKey($authKey)
//     {
//         return $this->authKey === $authKey;
//     }

//     /**
//      * Validates password
//      *
//      * @param string $password password to validate
//      * @return bool if password provided is valid for current user
//      */
//     public function validatePassword($password)
//     {
//         return $this->password === $password;
//     }
// }