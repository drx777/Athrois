<?php

namespace Athrois;

class Collection {

    private $elementType;

    private $elements;

    /**
     * @param string|null $type only valid class names are allowed, generic types are currently not supported, use null
     */
    public function __construct($type = null)
    {
        if (!is_null($type)) {
            assert(class_exists($type));
        }
        $this->elementType = $type;
    }

    public function add($element)
    {
        $this->ensureType($element);
        $this->elements[static::objectId($element)] = $element;
    }

    public function remove($element)
    {
        if (isset($this->elements[static::objectId($element)])) {
            unset ($this->elements[static::objectId($element)]);
        }
    }

    private function ensureType($element)
    {
        if (!is_null($this->elementType)) {
            assert($element instanceof $this->elementType);
        }
    }

    private static function objectId($object) {
        return spl_object_hash($object);
    }
}