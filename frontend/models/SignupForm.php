<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $firstname;
    public $lastname;
    public $username;
    public $email;
    public $phone;
    public $age;
    public $gender;
    public $password;
    public $verifyCode;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['firstname', 'trim'],
            ['firstname', 'required', 'message' => 'Your first name is reuired, you do have one, right?'],
            ['firstname', 'match', 'pattern' => '/^[a-zA-Z\s]+$/', 'message' => 'only Alphabets allowd'],
            ['firstname', 'string', 'min' => 2, 'max' => 255],
            
            ['lastname', 'trim'],
            ['lastname', 'required', 'message' => 'Your last name is reuired, you do have one, right?'],
            ['lastname', 'match', 'pattern' => '/^[a-zA-Z\s]+$/', 'message' => 'only Alphabets allowd'],
            ['lastname', 'string', 'min' => 2, 'max' => 255],
            
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['phone', 'trim'],
            ['phone', 'required'],
            ['phone', 'integer', 'message' => 'Please enter a valid phone number'],
            ['phone', 'string', 'min' => 10, 'max' => 14],
            
            ['age', 'trim'],
            ['age', 'required'],
            ['age', 'integer', 'message' => 'Please enter a valid age'],
            ['age', 'string', 'min' => 2, 'max' => 2],
            
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            
            ['verifyCode', 'captcha'],
            ['verifyCode', 'required']
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
