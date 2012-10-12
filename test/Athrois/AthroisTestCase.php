<?php

// curtsy http://zaemis.blogspot.de/2012/05/writing-minimal-psr-0-autoloader.html

spl_autoload_register(
    function ($className)
    {
        $className = ltrim($className, "\\");
        preg_match('/^(.+)?([^\\\\]+)$/U', $className, $match);
        $className = str_replace("\\", "/", $match[1])
            . str_replace(["\\", "_"], "/", $match[2])
            . ".php";
        $file = __DIR__ . '/../../src/' . $className;
        if (file_exists($file) && is_readable($file)) {}
            include_once $file;
    }
);

class AthroisTestCase extends PHPUnit_Framework_TestCase {

}