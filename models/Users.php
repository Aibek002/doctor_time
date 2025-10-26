<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $fullname
 * @property string $password_hash
 * @property string $gender
 * @property string $phone
 * @property string $birthday
 * @property string $email
 * @property string $auth_key
 */
class Users extends ActiveRecord implements IdentityInterface
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fullname', 'password_hash', 'gender', 'phone', 'birthday', 'email'], 'required'],
            [['fullname', 'password_hash', 'gender', 'phone', 'birthday', 'email'], 'string'],
            ['email', 'email'],
            ['password_hash', 'string', 'min' => 6],
            ['auth_key', 'string', 'max' => 32],
            // ['password_hash', 'validatePassword'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullname' => 'Fullname',
            'password_hash' => 'Password Hash',
            'gender' => 'Gender',
            'phone' => 'Phone',
            'birthday' => 'Birthday',
            'email' => 'Email',
        ];
    }
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token]);
    }
    public static function findByUsername($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($auth_key)
    {
        return $this->auth_key === $auth_key;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }


}
