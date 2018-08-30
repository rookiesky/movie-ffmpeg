<?php
/**
 * Created by PhpStorm.
 * User: rookie
 * Date: 2018/8/23
 * Time: 17:38
 */

namespace App\Tools;


trait MessageApi
{
    /**
     * return success message
     * @param string $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function successMsg(string $message,array $data = [])
    {
       return $this->messageForm($message,200,$data);
    }

    /**
     * return error message
     * @param string $message
     * @param int $code header code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorMsg(string $message,int $code = 402)
    {
        return $this->messageForm($message,$code);
    }

    /**
     * json rule
     * @param string $message
     * @param int $code
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function messageForm(string $message,int $code,array $data = [])
    {
        return $this->responseJson(
            [
                'message' => $message,
                'data' => $data
            ],
            $code
        );
    }
    /**
     * @param array $data message
     * @param int $code header code
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseJson(array $data,$code = 200)
    {
       return response()->json($data,$code);
    }
}