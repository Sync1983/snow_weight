<?php

namespace app\controllers;

class IncomController extends \yii\web\Controller {
  public function actionLoad() {
    $this->layout = "dummy.php";
    $data = ["get"=> $_SERVER['QUERY_STRING']];
    
    return $this->render('load',$data);
  }
}
