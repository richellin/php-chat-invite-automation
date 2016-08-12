<?php
namespace richellin\chat\Channel;

use richellin\chat\Channel\Channel;
use richellin\chat\Curl;

class Slack implements Channel
{
    private $set = array();
    private $validation = ['team_name','email','channel','token'];
    private $url = 'https://#team_name#.slack.com/api/users.admin.invite';
    private $err_msg = '';
    
    public function set($set)
    {
        $this->set = $set;
        return $this;
    }
    
    public function send()
    {
        $flg = false;
        if (self::validation()) {
            $url = str_replace('#team_name#', $this->set['team_name'], $this->url);
            $data = [
                'encoding'=>'gzip,deflate',
                'q'=>[
                    'email' => $this->set['email'],
                    'channel' => $this->set['channel'],
                    'token' => $this->set['token'],
                ],
            ];
            
            $html = Curl::request('POST', $url, $data);
            $res = json_decode($html, true);
            if (isset($res['ok'])) {
                if ($res['ok'] == true) {
                    $flg = true;
                } else {
                    $this->err_msg = "Err : {$res['error']}";
                }
            } else {
                $this->err_msg = "Err : not found curl";
            }
        }
        
        return $flg;
    }
    
    public function errMsg()
    {
        return $this->err_msg;
    }
    
    public function validation()
    {
        $flg = true;
        foreach ($this->validation as $name) {
            if (!isset($this->set[$name])) {
                $this->err_msg = "Set {$name} in parameter!";
                $flg = false;
            } elseif (trim($this->set[$name]) == '') {
                $this->err_msg = "Set {$name} in parameter!";
                $flg = false;
            }
            
            if ($flg == false) {
                break;
            }
        }
        return $flg;
    }
}
