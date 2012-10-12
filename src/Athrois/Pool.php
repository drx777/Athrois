<?php
/**
 *
 *
 * @author David Rekowski <mail@rekowski.info>
 * @license
 *
 * @package Athrois
 *
 * @version $Id:$
 *
 */

namespace Athrois;

class Pool {

    private $listeners = array();

    public function register(Listener $object, Event $event)
    {
        $this->listeners[static::getId($event)][] = $object;
    }

    public function notify(Event $event) {
        foreach ($this->getListeners($event) as $listener)
        {
            /**
             * @var Listener $listener
             */
            $listener->notify($event);
        }
    }

    public function unsubscribe(Listener $listener, Event $event = null)
    {
        foreach ($this->listeners as $eventType => &$eventListeners) {
            foreach ($eventListeners as $i => $currentListener) {
                if ($currentListener == $listener) {
                    unset($this->listeners[$eventType][$i]);
                }
            }
            if (count($eventListeners) == 0) {
                unset($this->listeners[$eventType]);
            }
        }
    }

    private function getListeners(Event $event)
    {
        $eventId = static::getId($event);
        return (isset($this->listeners[$eventId]))
            ? $this->listeners[$eventId]
            : array();
    }

    private static function getId($event)
    {
        return get_class($event);
    }

}