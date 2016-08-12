<?php
namespace richellin\chat\Channel;

use richellin\chat\Channel\Channel;

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
            
            $client = new \GuzzleHttp\Client();
            
            $response = $client->request('POST', $url, [
                'form_params' => [
                    'email' => $this->set['email'],
                    'channel' => $this->set['channel'],
                    'token' => $this->set['token'],
                ]
            ]);
            
            $status_code = $response->getStatusCode();
            
            if ($status_code === 200) {
                $res = json_decode($response->getBody(), true);
                if (isset($res['ok'])) {
                    if ($res['ok'] === true) {
                        $flg = true;
                    } else {
                        $this->err_msg = "Err : {$res['error']}";
                    }
                }
            } else {
                $this->err_msg = "Err : {$status_code} code";
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
