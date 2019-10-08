<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property int $id
 * @property string $name
 * @property string $second_name
 * @property string $date_of_birth
 * @property string $photo
 * @property int $phone
 *
 * @property Client[] $clients
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'second_name', 'date_of_birth', 'phone'], 'required'],
            [['date_of_birth'], 'safe'],
            [['phone'], 'integer'],
            [['name', 'second_name'], 'string', 'max' => 200],
            [['photo'], 'string', 'max' => 400],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'name' => 'Имя',
            'second_name' => 'Фамилия',
            'date_of_birth' => 'Дата рождения',
            'photo' => 'Фото',
            'phone' => 'Телефон',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasMany(Client::className(), ['person_id' => 'id']);
    }
}
