<?php

namespace Spine;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SpineSpec extends ObjectBehavior
{
    function let() {
        $this->beConstructedThrough('assemble', []);
        $this->reset();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Spine\Spine');
    }

    function it_assembles() {
        $this::assemble()->shouldBeAnInstanceOf('Spine\Spine');
    }

    function it_resets() {
        $this->reset()->shouldBeAnInstanceOf('Spine\Spine');
        $this->getVertebrae()->shouldReturn([]);
    }

    function it_attach_and_detach_vertebrae() {
        $this->attach('test', 'TestClass')->shouldBeAnInstanceOf('Spine\Spine');
        $this->getVertebrae()->shouldReturn(['test' => 'TestClass']);

        $this->detach('test')->shouldBeAnInstanceOf('Spine\Spine');
        $this->getVertebrae()->shouldReturn([]);
    }

    function it_resolves_dependencies() {
        $this->attach('Test', 'Spine\Test');
        $this->__get('test')->shouldBeAnInstanceOf('Spine\Test');
    }

}

class Test {
    private $another;

    public function __construct(Another $test) {
        $this->another = $test;
    }

    public function another() {
        return $this->another();
    }
}

class Another {}