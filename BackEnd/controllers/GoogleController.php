<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class GoogleController extends Controller
{
    /**
     * {@inheritdoc}
     */
     public function behaviors()
     {
         return [
             'corsFilter' => [
                 'class' => \yii\filters\Cors::className(),
             ],
         ];
     }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionSearch()
    {
      $request_data = Yii::$app->request->get();
      if(isset($request_data['s']) && $request_data['s']!=""){
        $search=$request_data['s'];
      }else{
        $search="maecenas";
      }
      if(isset($request_data['p']) && $request_data['p']!=""){
        $page=$request_data['p'];
      }else{
        $page=1;
      }

      // calling the google componet to fetch data from DB
      $data=Yii::$app->search->google($search, $page);

      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      return [
          'data' => $data,
          'code' => 100,
      ];
    }
}
