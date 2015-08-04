<?php

namespace Athrois;

class AthroisPoolTest extends \PHPUnit_Framework_TestCase
{

    public function testRegister() {
        $pool = new Pool();

        $mockEvent = $this->getMockBuilder('Athrois\\Event')->getMock();
        $mockListener = $this->getMockBuilder('Athrois\\Listener')->getMock();
        $identifier = Pool::getId($mockEvent);

        $pool->register($mockListener, $identifier);

        $this->assertAttributeEquals(array($identifier => array($mockListener)), 'listeners', $pool);
    }

    public function testNotify() {
        $pool = new Pool();

        $mockEvent = $this->getMockBuilder('Athrois\\Event')->getMock();

        $mockListener = $this
            ->getMockBuilder('Athrois\\Listener')
            ->setMethods(array('notify'))
            ->getMock();
        $mockListener
            ->expects($this->once())
            ->method('notify')
            ->with($this->equalTo($mockEvent));

        $pool->register($mockListener, Pool::getId($mockEvent));

        $pool->notify($mockEvent);
    }

    public function testUnsubscribe() {

        $pool = new Pool();

        $mockEvent1 = $this->getMockBuilder('Athrois\\Event')->getMock();
        $mockEvent2 = $this->getMockBuilder('AnotherEvent')->getMock();
        $mockListener = $this->getMockBuilder('Athrois\\Listener')->getMock();
        $identifier1 = Pool::getId($mockEvent1);
        $identifier2 = Pool::getId($mockEvent2);

        $pool->register($mockListener, $identifier1);
        $pool->register($mockListener, $identifier2);
        $pool->unsubscribe($mockListener, $identifier1);

        $this->assertAttributeEquals(array($identifier2 => array($mockListener)), 'listeners', $pool);
    }

    public function testUnsubscribeAll() {

        $pool = new Pool();

        $mockEvent1 = $this->getMockBuilder('Athrois\\Event')->getMock();
        $mockEvent2 = $this->getMockBuilder('AnotherEvent')->getMock();
        $mockListener = $this->getMockBuilder('Athrois\\Listener')->getMock();
        $identifier1 = Pool::getId($mockEvent1);
        $identifier2 = Pool::getId($mockEvent2);

        $pool->register($mockListener, $identifier1);
        $pool->register($mockListener, $identifier2);
        $pool->unsubscribe($mockListener);

        $this->assertAttributeEquals(array(), 'listeners', $pool);
    }

}