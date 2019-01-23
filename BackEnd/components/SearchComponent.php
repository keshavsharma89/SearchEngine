<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use app\models\Websites;

class SearchComponent extends Component
{

  public function google($search, $page=1, $limit=5)
  {
    // this will log the seach string to DB
    Yii::$app->logs->insert($search);

    $search=str_replace(" ","%",$search);

    // we will serch the data using these model functions.
    $count =Websites::countSearchData($search);

    $offset=($limit*$page)-$limit;
    $data =Websites::listSearchData($search, $limit, $offset);
    // truncate title and description
    foreach($data as $i=>$item){
       if(strlen($item["title"]) > 70) {
          $data[$i]["title"] = preg_replace("/^(.{1,70})(\s.*|$)/s", '\\1...', $item["title"]);
       }
       if(strlen($item["description"]) > 200) {
          $data[$i]["description"] = preg_replace("/^(.{1,200})(\s.*|$)/s", '\\1...', $item["description"]);
       }
    }

    return [
        'list' => $data,
        'count' => $count,
    ];
  }
}
