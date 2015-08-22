<?php

namespace Spine;

use Mockery;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


class MetaboxSpec extends ObjectBehavior
{
    private $field;
    private $wordpress;

    public function let() {
        $field = Mockery::mock('Spine\Form\Field');
        $wordpress = Mockery::mock('Spine\Adapters\Wordpress');
        $this->beConstructedWith($field, $wordpress);
        $this->field = $field;
        $this->wordpress = $wordpress;
    }

    public function letgo() {
        Mockery::close();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Spine\Metabox');
    }

    function it_sets_context() {
        $this->context('context')->shouldReturn($this);
        $this->__get('context')->shouldReturn('context');
    }

    function it_makes_metabox() {
        $this->wordpress->shouldReceive('addAction')->once();
        $this->make('slug', 'name')->shouldBeAnInstanceOf('Spine\Metabox');
        $this->__get('slug')->shouldReturn('slug');
        $this->__get('title')->shouldReturn('name');
    }

    public function it_adds_fields() {
        $this->field->shouldReceive('make')->once()->with('text', 'text')->andReturnSelf();
        $this->addField('text')->shouldBeAnInstanceOf('Spine\Form\Field');
    }

    public function it_adds_multiple_fields() {
        $this->field->shouldReceive('make')->with('name', 'text')->andReturn(['name' => 'text']);
        $this->addField('name', 'text');

        $this->field->shouldReceive('make')->with('message', 'textarea')->andReturn(['message' => 'textarea']);
        $this->addField('message', 'textarea');

        $this->__get('fields')->shouldReturn([
            ['name' => 'text'],
            ['message' => 'textarea']
        ]);
    }

    public function it_renders_metabox_form() {
        $this->field->shouldReceive('make')->with('test', 'text')->andReturnSelf();
        $this->addField('test');

        $this->wordpress->shouldReceive('addNonce')->with(null)->once()->andReturn('null');
        $this->field->shouldReceive('render')->once()->andReturn(null);

        $this->renderForm();
    }

    public function it_saves_metabox() {
        $this->field->shouldReceive('make')->with('test', 'text')->andReturnSelf();
        $this->addField('test');

        $this->wordpress->shouldReceive('verifyNonce')->with(null)->once()->andReturn(true);
        $this->field->shouldReceive('save')->once()->andReturn(null);

        $this->save()->shouldReturn(true);
    }

}
