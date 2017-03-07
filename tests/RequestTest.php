<?php


class RequestTest extends PHPUnit_Framework_TestCase
{

    public function testIsThereAnySyntaxError()
    {
        $var = new Snelling\Request;
        $this->assertTrue(is_object($var));
        unset($var);
    }
}