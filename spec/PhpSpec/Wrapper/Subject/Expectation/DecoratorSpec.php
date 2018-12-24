<?php

declare(strict_types=1);

namespace spec\PhpSpec\Wrapper\Subject\Expectation;

use PhpSpec\ObjectBehavior;

use PhpSpec\Wrapper\Subject\Expectation\Decorator as AbstractDecorator;
use PhpSpec\Wrapper\Subject\Expectation\Expectation;

class DecoratorSpec extends ObjectBehavior
{
    public function let(Expectation $expectation)
    {
        $this->beAnInstanceOf('spec\PhpSpec\Wrapper\Subject\Expectation\Decorator');
        $this->beConstructedWith($expectation);
    }

    public function it_returns_the_decorated_expectation(Expectation $expectation)
    {
        $this->getExpectation()->shouldReturn($expectation);
    }

    public function it_keeps_looking_for_nested_expectations(AbstractDecorator $decorator, Expectation $expectation)
    {
        $decorator->getExpectation()->willReturn($expectation);
        $this->beAnInstanceOf('spec\PhpSpec\Wrapper\Subject\Expectation\Decorator');
        $this->beConstructedWith($decorator);

        $this->getNestedExpectation()->shouldReturn($expectation);
    }
}

class Decorator extends AbstractDecorator
{
    public function match(string $alias, $subject, array $arguments = [])
    {
    }
}