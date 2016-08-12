<?php
namespace richellin\chat\Channel;

interface Channel
{
    public function set($set);
    
    public function send();
    
    public function errMsg();
    
    public function validation();
}
