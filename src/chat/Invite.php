<?php
namespace richellin\chat;

use richellin\chat\Channel\Channel;

class Invite
{
    private $channel;
    
    public function __call($method, $params)
    {
        if ($this->channel && method_exists($this->channel, $method)) {
            call_user_func_array(array(&$this->channel, $method), $params);
        } else {
            throw new Exception("Not Function :{$method}");
        }
        return $this;
    }
    
    public function channel(Channel $channel)
    {
        $this->channel = $channel;
        return $this;
    }
    public function set($params)
    {
        $this->channel->set($params);
        return $this;
    }
    
    public function send()
    {
        return $this->channel->send();
    }
    
    public function errMsg()
    {
        return $this->channel->errMsg();
    }
}
