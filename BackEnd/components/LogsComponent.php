<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use app\models\Logs;

class LogsComponent extends Component
{

  public function insert($search)
  {
    return Logs::addLogs($search);
  }
}
