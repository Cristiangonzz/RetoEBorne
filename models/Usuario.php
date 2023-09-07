<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use Ramsey\Uuid\Uuid;

/**
 * This is the model class for table "usuario".
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $available
 * @property int $admin
 */
class Usuario extends ActiveRecord implements IdentityInterface
{

    private $_user = false;
    public $rememberMe = false;
    //public $id;
    public $username;
    //public $password;
    public $authKey;
    public $accessToken;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    public function __construct($config = [])
    {
        parent::__construct($config);

        // Generar un UUID v4 y asignarlo al atributo 'id' al crear una nueva instancia
        $this->id = Uuid::uuid4()->toString();
        $this->available = 1;
        $this->admin = 0;
        
    }

   

	public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function validateAuthKey($authKey){
        return $this->authKey === $authKey;
    }
    public function getUser() {
        if ($this->_user === false) {
            $this->_user = Usuario::findByUsername($this->email);
        }
		
        return $this->_user;
    }

    /**
	* {@inheritdoc}
	*/
	public function getId(){
		return $this->id;
    }

	/**
		* {@inheritdoc}
		*/
	public function getAuthKey()
	{
		return $this->authKey;
	}
    public function rules()
    {
        return [
            [['name', 'email','password'], 'required'],
            [['available', 'admin'], 'integer'],
            [['id'], 'string', 'max' => 100],
            [['name', 'email', 'password'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name*',
            'email' => 'Email*',
            'password' => 'Password*',
            'available' => 'Available',
            'admin' => 'Admin',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }


    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function obtenerUsuarios()
    {
        $usuarios = Usuario::find()->all();
        return $usuarios;
    }

    public function login($pwdIngresada, $modelUsuario)
    {
        if (Yii::$app->getSecurity()->validatePassword($pwdIngresada, $modelUsuario->password)) {
            
            $_SESSION['usuario'] = array(
                "idUsuario" => $modelUsuario->id,
                "nombreUsuario" => $modelUsuario->name,
                "tipoUsuario" => $modelUsuario->admin
            );
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    public function crearUsuarioModelo($model)
    {
        $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
        if ($model->save()) {
            return true;
        } else {
            return false;
        }
    }

   

    public function obtenerUsuario($idUsuario)
    {
        $model = Usuario::find()->where(['id' => $idUsuario])->one();
        return $model->email;
    }

    public static function findByUsername($email)
    {
        return static::findOne(['email' => $email]);
    }

}
