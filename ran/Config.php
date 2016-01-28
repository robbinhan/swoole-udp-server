<?php
namespace ran;

class Config {
  public static function getJobs() {
    return [
      2=>[
        'class'=>'SumPayAmount',
        // 'dependencies'=>[],//or null
        'retries'=>2,// or null
        'params'=>[],
      ],

      1=>[
        'class'=>'SumPayAmount',
        // 'dependencies'=>[],//or null
        'retries'=>2,// or null
        'params'=>[],
      ],

      3=>[
        'class'=>'SumPayAmount',
        // 'dependencies'=>[],//or null
        'retries'=>2,// or null
        'params'=>[],
      ],

      4=>[
        'class'=>'SumPayAmount',
        // 'dependencies'=>[],//or null
        'retries'=>2,// or null
        'params'=>[],
      ]


    ];
  }

  public static function getNotify() {
    return [
        'dispatch_mode'=>1,//1:mail,2:rtx
        'users'=>''
    ];
  }
}
