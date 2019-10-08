<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hall".
 *
 * @property int $id
 * @property string $name
 * @property int $studio_id
 * @property string $info
 *
 * @property Studio $studio
 */
class Hall extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hall';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'studio_id'], 'required'],
            [['studio_id'], 'integer'],
            [['info'], 'string'],
            [['name'], 'string', 'max' => 200],
            [['studio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Studio::className(), 'targetAttribute' => ['studio_id' => 'id']],
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
            'studio_id' => 'Studio ID',
            'info' => 'Info',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudio()
    {
        return $this->hasOne(Studio::className(), ['id' => 'studio_id']);
    }
}
