<?php

namespace spec\Madkom;

use Madkom\Game;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class GameSpec
 * @package spec\Madkom
 * @mixin Game
 */
class GameSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Game::class);
    }

    function it_should_throw_all_zeros()
    {
        $this->throwBallMultipleTimes(0, 20);

        $this->score()->shouldReturn(0);
    }

    function it_should_throw_all_ones()
    {
        $this->throwBallMultipleTimes(1, 20);

        $this->score()->shouldReturn(20);
    }

    function it_should_throw_one_spare()
    {
        $this->throwSpare(5);
        $this->throwBallMultipleTimes(1, 18);

        $this->score()->shouldReturn(29);
    }

    function it_should_throw_one_strike()
    {
        $this->throwStrike();
        $this->throwBallMultipleTimes(1, 18);

        $this->score()->shouldReturn(30);
    }

    function it_should_throw_one_spare_in_last_frame()
    {
        $this->throwBallMultipleTimes(1, 18);
        $this->throwSpare(5);
        $this->throwBall(5);

        $this->score()->shouldReturn(33);
    }

    function it_should_throw_one_strike_in_last_frame()
    {
        $this->throwBallMultipleTimes(1, 18);
        $this->throwStrike();
        $this->throwBall(4);
        $this->throwBall(5);

        $this->score()->shouldReturn(37);
    }

    /**
     * @param int $pins
     * @param int $times
     */
    private function throwBallMultipleTimes(int $pins, int $times):void
    {
        for ($i = 0; $i < $times; $i++) {
            $this->throwBall($pins);
        }
    }

    /**
     * @param int $firstPins
     */
    private function throwSpare(int $firstPins):void
    {
        $this->throwBall($firstPins);
        $this->throwBall(10 - $firstPins);
    }

    private function throwStrike():void
    {
        $this->throwBall(10);
    }
}
