<?php

require_once("src/igeo.php");
require_once("src/geo.php");

class GeoTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {

    }

    public function tearDown()
    {

    }

    public function testMinimumViableTest()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue(true, "true didn't end up being false!");
    }

    public function testGeo()
    {
        $g = new \kdaviesnz\geo\Geo("74.120.99.138");
        echo $g;
    }

}
