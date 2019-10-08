<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "studio".
 *
 * @property int $id
 * @property string $name
 * @property string $info
 *
 * @property Hall[] $halls
 */
class Studio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'studio';
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
    public function getHalls()
    {
        return $this->hasMany(Hall::className(), ['studio_id' => 'id']);
    }
}
