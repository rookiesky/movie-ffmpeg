<?php
/**
 * Created by PhpStorm.
 * User: rookie
 * Date: 2018/9/3
 * Time: 19:01
 */

namespace App\Tools;


class SshConnect
{

    protected $connect;

    private $stream;

    public $error;


    /**
     * SshConnect constructor.
     * @param $host server host ip
     * @param $port server host port
     * @param $user
     * @param $passwd
     */
    public function __construct($host,$port,$user,$passwd)
    {
        $connect = ssh2_connect($host,$port);

        if(!ssh2_auth_password($connect,$user,$passwd)){
            die('账号密码错误！');
        }
        $this->connect = $connect;
    }

    public function exec($comment)
    {
        $this->stream = ssh2_exec($this->connect,$comment);
        return $this->stream;
    }

    public function getBody()
    {
        $error = $this->join(SSH2_STREAM_STDERR);
        if($error){
            $this->error = $error;
            return false;
        }

        return $this->join(SSH2_STREAM_STDIO);
    }

    private function join($type,$bool=true)
    {
        $stream = $this->fetchStream($this->stream,$type);
        $this->setBlocking($stream,$bool);
        return $this->getContents($stream);
    }

    private function fetchStream($stream,$type)
    {
        return ssh2_fetch_stream($stream,$type);
    }

    private function setBlocking($stream,$type = true)
    {
        stream_set_blocking($stream,$type);
    }

    private function getContents($stream)
    {
        $result = stream_get_contents($stream);
        fclose($stream);
        return trim($result);
    }

}