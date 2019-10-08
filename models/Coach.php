<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "coach".
 *
 * @property int $id
 * @property int $person_id
 * @property int $tarif
 * @property string $note
 */
class Coach extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coach';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id'], 'required'],
            [['person_id', 'tarif'], 'integer'],
            [['note'], 'string'],
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
            'tarif' => 'Ставка',
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
