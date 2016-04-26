<?php
use \richellin\chat\Invite;
use \richellin\chat\Channel\Slack;
Class slackTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->invite = new Invite;
        $this->channel = new Slack;
        
        $this->channel->set([
            'team_name'=> 'Your team name',
            'email'=> 'Email',
            'channel'=> 'Channel',
            'token'=> 'xoxp-token'
        ]);
        
    }
    
    public function testInstanceOf()
    {
        $this->assertInstanceOf(Slack::class, $this->channel);
    }
    
    
    public function testChannel()
    {
        $this->assertInstanceOf(Invite::class, $this->invite->channel($this->channel));
    }
    
    public function testCheckAttr()
    {
        $this->assertObjectHasAttribute('set', $this->channel);
        $this->assertObjectHasAttribute('validation', $this->channel);
        $this->assertObjectHasAttribute('url', $this->channel);
        $this->assertObjectHasAttribute('err_msg', $this->channel);
    }
    
    public function testValidation()
    {
        $this->assertEquals(TRUE, $this->channel->validation());
    }
}