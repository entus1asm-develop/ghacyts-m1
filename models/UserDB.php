<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property int $phone
 * @property string $email
 * @property string|null $acces_token
 * @property string|null $auth_key
 *
 * @property Complaint[] $complaints
 */
class UserDB extends \yii\db\ActiveRecord
{
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
            [['username', 'password', 'name', 'surname', 'patronymic', 'phone', 'email'], 'required'],
            [['phone'], 'integer'],
            [['username', 'password', 'name', 'surname', 'patronymic'], 'string', 'max' => 63],
            [['email'], 'string', 'max' => 127],
            [['acces_token', 'auth_key'], 'string', 'max' => 255],
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
            'password' => 'Password',
            'name' => 'Name',
            'surname' => 'Surname',
            'patronymic' => 'Patronymic',
            'phone' => 'Phone',
            'email' => 'Email',
            'acces_token' => 'Acces Token',
            'auth_key' => 'Auth Key',
        ];
    }

    /**
     * Gets query for [[Complaints]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComplaints()
    {
        return $this->hasMany(Complaint::class, ['id_user' => 'id']);
    }
}
