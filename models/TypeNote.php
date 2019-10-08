<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type_note".
 *
 * @property int $id
 * @property string $name
 * @property string $info
 *
 * @property Sheldule[] $sheldules
 */
class TypeNote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type_note';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['info'], 'string'],
            [['name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'info' => 'Info',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSheldules()
    {
        return $this->hasMany(Sheldule::className(), ['type_note' => 'id']);
    }
}
