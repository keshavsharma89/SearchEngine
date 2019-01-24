<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "websites".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $url
 * @property int $rating
 * @property string $keywords
 * @property string $country
 * @property string $temp_company
 * @property string $temp_words
 */
class Websites extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'websites';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rating'], 'integer'],
            [['description', 'keywords', 'temp_words'], 'string'],
            [['title', 'country', 'temp_company'], 'string', 'max' => 50],
            [['url'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'url' => 'Url',
            'rating' => 'Rating',
            'keywords' => 'Keywords',
            'country' => 'Country',
            'temp_company' => 'Temp Company',
            'temp_words' => 'Temp Words',
        ];
    }

    // this function will query and return the list of all found results
    public static function listSearchData($search, $limit, $offset){
        $data = Websites::find()
        ->select(['title','description', 'url'])
        ->where(['like', 'keywords', '%' . $search . '%', false])
        ->orWhere(['like', 'title', '%' . $search . '%', false])
        ->orWhere(['like', 'url', '%' . $search . '%', false])
        ->limit($limit)
        ->offset($offset)
        ->asArray()
        ->all();

        return $data;
    }

    // this function will query and return the count of all the possible results
    public static function countSearchData($search){
        $count = Websites::find()
        ->where(['like', 'keywords', '%' . $search . '%', false])
        ->orWhere(['like', 'title', '%' . $search . '%', false])
        ->orWhere(['like', 'url', '%' . $search . '%', false])
        ->count();

        return $count;
    }
}
