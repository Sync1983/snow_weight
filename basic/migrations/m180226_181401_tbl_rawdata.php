<?php

use yii\db\Migration;

/**
 * Class m180226_181401_tbl_rawdata
 */
class m180226_181401_tbl_rawdata extends Migration{

 public function up(){
   $this->createTable('rawdata', [
                  'IMEI'                => 'BIGSERIAL PRIMARY KEY',
                  'date'                => 'timestamp without time zone',
                  'geo'                 => 'point',
                  'raw_data'            => 'INTEGER',                  
   ]);
 }

 public function down() {
     return $this->dropTable('rawdata');
 }
}
