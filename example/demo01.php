<?php

namespace AthroisExample\Demo01;

require_once __DIR__ . '/../src/autoloader.php';

use \Athrois\Pool;
use \Athrois\Event;
use \Athrois\Listener;

class DemoListener implements Listener {

    public function notify(Event $event) {
        printf("Event of type '%s' triggered with value %d\n", get_class($event), $event->value());
    }
}

class DemoEvent implements Event {

    private $value;

    public function __construct() {
        $this->value = rand(1, 100);
    }

    public function value() {
        return $this->value;
    }
}

class DemoNotifier {

    /**
     * @var \Athrois\Pool
     */
    private $pool;

    public function __construct(Pool $pool) {
        $this->pool = $pool;
    }

    public function trigger($event) {
        printf("Triggering event...\n");
        $this->pool->notify($event);
    }
}

$listener = new DemoListener();
$event = new DemoEvent();

$pool = new Pool();
$pool->register($listener, $event);

$notifier = new DemoNotifier($pool);
$notifier->trigger(new DemoEvent());
$pool->unsubscribe($listener, $event);
$notifier->trigger(new DemoEvent());
$pool->register($listener, $event);
$notifier->trigger(new DemoEvent());