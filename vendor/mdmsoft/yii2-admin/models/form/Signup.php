<?php
namespace mdm\admin\models\form;

use mdm\admin\components\UserStatus;
use mdm\admin\models\User;
use mdm\admin\models\Assignment;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Signup form
 */
class Signup extends Model
{
    public $username;
    public $fullname;
    public $sex;
    public $email;
    public $password;
    public $role;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $class = Yii::$app->getUser()->identityClass ? : 'mdm\admin\models\User';
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => $class, 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['fullname', 'filter', 'filter' => 'trim'],
            ['fullname', 'required'],
            ['fullname', 'string', 'max' => 255],
            ['fullname', 'unique', 'targetClass' => $class, 'message' => 'This fullname has already been taken.'],

            ['sex', 'in', 'range' => array_keys(\common\models\User::$sexList)],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => $class, 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['role', 'required'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $class = Yii::$app->getUser()->identityClass ? : 'mdm\admin\models\User';
            $user = new $class();
            $user->username = $this->username;
            $user->fullname = $this->fullname;
            $user->sex = $this->sex;
            $user->email = $this->email;
            $user->status = ArrayHelper::getValue(Yii::$app->params, 'user.defaultStatus', UserStatus::ACTIVE);
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                // Assign role to created user
                $model = new Assignment($user->id);
                $model->assign($this->role);

                return $user;
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Tên đăng nhập',
            'fullname' => 'Họ tên đầy đủ',
            'sex' => 'Giới tính',
            'password' => 'Mật khẩu',
            'email' => 'Email',
            'role' => 'Vai trò',
        ];
    }
}
