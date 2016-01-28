<?php
date_default_timezone_set('Asia/Shanghai');

$serv = new swoole_server('0.0.0.0', 9094, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);

$serv->set([
  'worker_num' => 1,
  'task_worker_num' => 4,
  'daemonize' => false,
  'log_file' => '/tmp/swoole_udp_server.log',
]);

$serv->on('receive', function (swoole_server $serv, $fd, $reactor_id, $data){
    $task_id = $serv->task($data);
    $ymdhi = date('YmdHi');
    swoole_async_write('/tmp/'.$ymdhi.'.txt', $data."\n", -1);
});

$serv->on('task', function ($serv, $task_id, $from_id, $data) {
    var_dump($serv->taskworker,$serv->worker_id,$serv->worker_pid);
    \ran\Ran::run($serv->worker_id,$data);
    return true;
});

$serv->on('finish', function () {

});

$serv->on('start', function ($serv) {
   swoole_async_writefile('/tmp/swoole_master_pid.log', $serv->master_pid,function($filename){
   });
  //  swoole_set_process_name("php swoole udp server master".$serv->master_pid);
});

$serv->on('workerStart', function ($serv, $worker_id){
    if ($worker_id >= $serv->setting['worker_num']) {  //超过worker_num，表示这是一个task进程
        // swoole_set_process_name("php swoole udp server tasker ".$worker_id);
        echo "$worker_id tasker start\n";
        require './vendor/autoload.php';
    } else {
        echo "$worker_id worker start\n";
        // swoole_set_process_name("php swoole udp server worker ".$worker_id);
    }
});

$serv->start();
