<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "complaint".
 *
 * @property int $id
 * @property int $id_user
 * @property string $car_number
 * @property string $description
 * @property int $id_status
 *
 * @property Status $status
 * @property User $user
 */
class Complaint extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'complaint';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'car_number', 'description', 'id_status'], 'required'],
            [['id_user', 'id_status'], 'integer'],
            [['description'], 'string'],
            [['car_number'], 'string', 'max' => 6],
            [['id_status'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['id_status' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'car_number' => 'Car Number',
            'description' => 'Description',
            'id_status' => 'Id Status',
        ];
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'id_status']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }
}
