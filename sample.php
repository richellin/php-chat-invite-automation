<?php
require 'vendor/autoload.php';
use \richellin\chat\Invite;
use \richellin\chat\Channel\Slack;
$invite = new Invite();
$res = $invite->channel(new Slack())
              ->set([
                'team_name'=> 'Your team name',
                'email'=> 'Email',
                'channel'=> 'Channel',
                'token'=> 'xoxp-token'
                ])
              ->send();
if($res === FALSE){
    echo $invite->errMsg();
}
