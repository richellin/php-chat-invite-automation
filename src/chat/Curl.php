<?php
namespace richellin\chat;
trait Curl{
    static public function request($type,$url,$data){
        $html = '';
        if(function_exists('curl_version')){
            $type = mb_strtoupper($type,'UTF-8');
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_AUTOREFERER,true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            if(isset($data['encoding'])){
                curl_setopt($ch, CURLOPT_ENCODING, $data['encoding']);
            }
            if($type == 'POST'){
                curl_setopt($ch, CURLOPT_POST, 1);
                
                if(isset($data['q'])){
                    $data = http_build_query($data['q']);
                }else{
                    $data = isset($data['data'])?$data['data']:array();
                }
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }else{
                curl_setopt($ch, CURLOPT_POST, 0);
            }
            $html = curl_exec($ch);
            $info = curl_getinfo($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        }
        return $html;
    }
}