<?php

namespace ran\filters;

class Pay {
  public static function run($data) {
    return explode('|',$data);
  }
}
