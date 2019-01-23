<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "logs".
 *
 * @property int $id
 * @property string $search_string
 * @property string $created_date
 */
class Logs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['search_string'], 'required'],
            [['search_string'], 'string'],
            [['created_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'search_string' => 'Search String',
            'created_date' => 'Created Date',
        ];
    }

    public static function addLogs($search){
      $LogsModel= new Logs();
      $LogsModel->search_string=$search;
      return $LogsModel->save();
    }
}
