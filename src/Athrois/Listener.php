<?php

namespace Athrois;

interface Listener {

    public function notify(Event $event);

}