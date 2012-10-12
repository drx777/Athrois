<?php

    require_once __DIR__ . '/AthroisTestCase.php';

class AthroisCollectionTest extends AthroisTestCase {


    public function testConstructor()
    {
        $mock = $this->getMockBuilder('NonexistantClass')->getMock();
        $mockType = get_class($mock);
        $collection = new Athrois\Collection($mockType);
        $this->assertAttributeEquals($mockType, 'elementType', $collection);
    }

    public function testAdd()
    {
        $mock = $this->getMockBuilder('NonexistantClass')->getMock();
        $mockType = get_class($mock);
        $collection = new Athrois\Collection($mockType);
        $collection->add($mock);
        $this->assertAttributeEquals(array(spl_object_hash($mock) => $mock), 'elements', $collection);
    }

    public function testRemove()
    {

        $mock = $this->getMockBuilder('NonexistantClass')->getMock();
        $mockType = get_class($mock);
        $collection = new Athrois\Collection($mockType);
        $collection->add($mock);
        $collection->remove($mock);
        $this->assertAttributeEquals(array(), 'elements', $collection);
    }
}
