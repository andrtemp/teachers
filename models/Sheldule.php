<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sheldule".
 *
 * @property int $id
 * @property string $time
 * @property string $date
 * @property int $client
 * @property int $coach
 * @property int $type_note
 * @property int $hall_id
 * @property string $note
 *
 * @property Coach $coach0
 * @property Client $client0
 * @property Status $typeNote
 */
class Sheldule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sheldule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time', 'end_time', 'date', 'type_note', 'hall_id'], 'required'],
            [['time', 'end_time', 'date'], 'safe'],
            [['client', 'coach', 'type_note', 'hall_id', 'done'], 'integer'],
            [['note'], 'string'],
            [['coach'], 'exist', 'skipOnError' => true, 'targetClass' => Coach::className(), 'targetAttribute' => ['coach' => 'id']],
            [['client'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['client' => 'id']],
            [['type_note'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['type_note' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'time' => 'Время начала',
            'end_time' => 'Время окончания',
            'date' => 'Дата',
            'client' => 'Клиент',
            'coach' => 'Тренер',
            'type_note' => 'Тип занятия',
            'hall_id' => 'Зал',
            'note' => 'Заметки',
            'done' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoach0()
    {
        return $this->hasOne(Coach::className(), ['id' => 'coach']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient0()
    {
        return $this->hasOne(Client::className(), ['id' => 'client']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeNote()
    {
        return $this->hasOne(Status::className(), ['id' => 'type_note']);
    }
}
