<?php
namespace ran\logics;

class SumPayAmount {
    private $filter = null;

    public function __construct(\ran\filters\Pay $filter){
        $this->filter = $filter;
    }

    public function run($data,$job_params) {

      list($logtype,$ts,$resource_id,$appid,$status,$qudao,$taocan,$region,$uid,$oid,$order_time,
      $pay_amount,$currency,$client_ip,$payref,$pubacct_payamt_coins,$payamt_coins,
      $extra_currency,$extra_field1,$extra_field2) = $this->filter->run($data);

      echo "runing SumPayAmount\n";
      // var_dump($logtype,$ts,$resource_id,$appid,$status,$qudao,$taocan,$region,$uid,$oid,$order_time,
      // $pay_amount,$currency,$client_ip,$payref,$pubacct_payamt_coins,$payamt_coins,
      // $extra_currency,$extra_field1,$extra_field2);
      return true;
    }
}
