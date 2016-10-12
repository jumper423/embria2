<?php

class CountingDomainsTest extends PHPUnit_Framework_TestCase
{
    public function testInstance()
    {
        $db = new class {
            public function row()
            {
                return ['ejejje@ff.ru', 1];
            }
        };
        $instance = new \jumper423\CountingDomains($db);
        return $instance;
    }

    /**
     * @param $instance \jumper423\CountingDomains
     * @depends testInstance
     */
    public function testGet($instance)
    {
        $this->assertEquals(['ff.ru' => 1], $instance->get());
    }

    public function testInstance2()
    {
        $db = new class {
            public function row()
            {
                return ['sfsf@mail.ru,sdvsdv@mail.ru,sdvsdv@list.ru,sdvsvd@ya.ru,sdvsv@list.ru,', 5];
            }
        };
        $instance = new \jumper423\CountingDomains($db);
        return $instance;
    }

    /**
     * @param $instance \jumper423\CountingDomains
     * @depends testInstance2
     */
    public function testGet2($instance)
    {
        $this->assertEquals(['mail.ru' => 2,'list.ru' => 2,'ya.ru' => 1], $instance->get());
    }
}