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

    public function register(Listener $object, $eventType)
    {
        $this->listeners[$eventType][] = $object;
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

    public function unsubscribe(Listener $listener, $eventType = null)
    {
        foreach ($this->listeners as $currentEventType => $eventListeners) {
            foreach ($eventListeners as $i => $currentListener) {
                if ($currentListener == $listener &&
                    is_null($eventType) || $currentEventType == $eventType) {
                    unset($this->listeners[$currentEventType][$i]);
                }
            }
            $this->cleanupListeners();
        }
    }

    private function cleanupListeners() {
        foreach ($this->listeners as $eventType => $listeners) {
            if (count($listeners) == 0) {
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

    public static function getId($event)
    {
        return get_class($event);
    }

}