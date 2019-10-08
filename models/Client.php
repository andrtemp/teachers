<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property int $id
 * @property int $person_id
 * @property int $second_phone
 * @property string $social
 * @property int $tarif
 * @property string $note
 *
 * @property Person $person
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['person_id'], 'required'],
            [['id', 'person_id', 'second_phone', 'tarif'], 'integer'],
            [['note'], 'string'],
            [['social'], 'string', 'max' => 400],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['person_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'person_id' => 'Человек',
            'second_phone' => 'Второй телефон',
            'social' => 'Социальные сети',
            'tarif' => 'Тариф',
            'note' => 'Заметки',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'person_id']);
    }


    public function getPersonName()
    {
        return $this->person->name;
    }



    public function getPersonSecondName()
    {
        return $this->person->second_name;
    }



    public function getPersonPhone()
    {
        return $this->person->phone;
    }
}
