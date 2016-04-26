<?php
use \richellin\chat\Invite;
Class inviteTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function setUp()
    {
        $this->class = new Invite;
    }
    
    public function testInstanceOf()
    {
        $this->assertInstanceOf(Invite::class, $this->class);
    }
}