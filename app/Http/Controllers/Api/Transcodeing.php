<?php

namespace App\Http\Controllers\Api;

use App\Tools\SshConnect;
use App\Http\Controllers\Controller;

class Transcodeing extends Controller
{
    public function transcodeList()
    {
        $server = $this->server();

        $commant = "ls " .$server->file_path;

        $connect = $this->command($server,$commant);

        $result = $connect->getBody();

        if($result == false){
            return [
                'status' => false,
                'error' => $connect->error
            ];
        }

        return [
            'status' => true,
            'data' => explode(PHP_EOL,$result)
        ];

    }

    public function codeingRun()
    {
        $server = $this->server();


        //$command = "sh /home/wwwroot/init.sh >/dev/null";
        $command = '/usr/bin/nohup sh /home/wwwroot/init.sh > /home/wwwroot/codeing.log &';
        //echo $command;die;
        $connect = $this->command($server,$command);

        $result = $connect->getBody();

        dd($result);



    }

    private function server()
    {
        return \App\Models\TransCodeing::first();
    }

    private function command($server,$command)
    {

        $connect = $this->connect($server);

        $connect->exec($command);

        return $connect;
    }



    private function connect(\App\Models\TransCodeing $server)
    {
        return new SshConnect($server->host,$server->port,$server->username,$server->password);;
    }
}
