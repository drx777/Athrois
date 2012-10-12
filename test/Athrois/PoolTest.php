<?php

require_once __DIR__ . '/AthroisTestCase.php';

class AthroisPoolTest extends AthroisTestCase
{

    public function testRegister() {
        $pool = new Athrois\Pool();

        $mockEvent = $this->getMockBuilder('Athrois\\Event')->getMock();
        $mockListener = $this->getMockBuilder('Athrois\\Listener')->getMock();
        $identifier = get_class($mockEvent);

        $pool->register($mockListener, $mockEvent);

        $this->assertAttributeEquals(array($identifier => array($mockListener)), 'listeners', $pool);
    }

    public function testNotify() {
        $pool = new Athrois\Pool();

        $mockEvent = $this->getMockBuilder('Athrois\\Event')->getMock();

        $mockListener = $this
            ->getMockBuilder('Athrois\\Listener')
            ->setMethods(array('notify'))
            ->getMock();
        $mockListener
            ->expects($this->once())
            ->method('notify')
            ->with($this->equalTo($mockEvent));

        $pool->register($mockListener, $mockEvent);

        $pool->notify($mockEvent);
    }

    public function testUnsubscribe() {

        $pool = new Athrois\Pool();

        $mockEvent = $this->getMockBuilder('Athrois\\Event')->getMock();
        $mockListener = $this->getMockBuilder('Athrois\\Listener')->getMock();
        $identifier = get_class($mockEvent);

        $pool->register($mockListener, $mockEvent);
        $pool->unsubscribe($mockListener, $mockEvent);

        $this->assertAttributeEquals(array(), 'listeners', $pool);
    }

}