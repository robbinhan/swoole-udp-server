<?php
namespace ran;

class Ran {
    public static function  run($worker_id,$data){

        $jobs = Config::getJobs();
        $job = &$jobs[$worker_id];

        if ($job === null) {
          var_dump($worker_id);
          return false;
        }

        $builder = new \DI\ContainerBuilder();
        // $builder->setDefinitionCache(new Doctrine\Common\Cache\RedisCache());
        $builder->writeProxiesToFile(true, 'tmp/proxies');
        // $builder->useAutowiring(false);
        $builder->useAnnotations(false);
        $builder->addDefinitions('diconfig.php');
        $container = $builder->build();


        // $dependencies = &$job['dependencies'];
        //
        // if ($dependencies !== null) {
        //     $dependencies_classes = explode(',',$dependencies);
        //     foreach($dependencies_classes  as $class) {
        //         $depend_jober = new $class($params);
        //         $params = $depend_jober->run();
        //         if ($params === false) {
        //             return false;
        //         }
        //     }
        // }

        $retries = &$job['retries'];
        $job_params = &$job['params'];
        $class = &$job['class'];
        $exec_count = 0;

        do {
            $result = $container->get($class)->run($data, $job_params);
            $exec_count++;
        } while($result === false && $exec_count<$retries);

        if ($result === false) {
            $notify = Config::getNotify();
            switch($notify['dispatch_mode']) {
              case 1:
                break;
              case 2:
                break;
            }
        }
    }
}
