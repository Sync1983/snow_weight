<?php

namespace app\controllers;

class IncomController extends \yii\web\Controller {
  public function actionLoad() {
    $this->layout = "dummy.php";
    $get = htmlentities($_GET['d']);
    $indata = explode(" ",$get);
    if(!$indata[1]){
      $indata[1] = 0.0;
    }
    if(!$indata[2]){
      $indata[2] = 0.0;
    }
    $data["IMEI"]       = $indata[0];
    $data["point"]      = "(".$indata[1].",".$indata[2].")";
    $data["weight"]     = $indata[3];
    $data["timestamp"]  = new \yii\db\Expression('NOW()');;
    
    $rd = new \app\models\Rawdata();
    $rd->IMEI = $data["IMEI"];
    $rd->date = $data["timestamp"];
    $rd->geo  = $data["point"];
    $rd->raw_data = $data["weight"];
    $rd->save();
    
    $out = ["a"=>$data['IMEI'], "b"=>$data["point"], "c"=>$data["weight"], "d"=>$data["timestamp"]];
    
    return $this->render('load',$out);
  }
  
  public function actionPoints(){    
    $sql = 'select MAX("date") as Date ,"IMEI", AVG("geo"[0]) as lat, AVG("geo"[1]) as lng, AVG("raw_data") as raw_data from rawdata group by "IMEI";';
    $all = \app\models\Rawdata::findBySql($sql)->asArray()->all();
    return json_encode($all);
  }

}
