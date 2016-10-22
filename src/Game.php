<?php

namespace Madkom;

/**
 * Class Game
 * @package Madkom
 */
class Game
{
    /**
     * @var array
     */
    private $ballThrows = [];

    /**
     * @param int $pins
     */
    public function throwBall(int $pins) : void
    {
        $this->ballThrows[] = $pins;
    }

    /**
     * @return int
     */
    public function score() : int
    {
        $score = 0;
        $firstThrowBallInFrame = 0;

        for ($frameNumber = 0; $frameNumber < 10; $frameNumber++) {
            if ($this->isSpare($firstThrowBallInFrame)) {
                $score += $this->pointsForSpare($firstThrowBallInFrame);
                $firstThrowBallInFrame += 2;
                continue;
            }
            if ($this->isStrike($firstThrowBallInFrame)) {
                $score += $this->pointsForStrike($firstThrowBallInFrame);

                $firstThrowBallInFrame += 1;
                continue;
            }

            $score += $this->pointsForStandardFrame($firstThrowBallInFrame);
            $firstThrowBallInFrame += 2;
        }

        return $score;
    }

    /**
     * @param $firstThrowBallInFrame
     * @return bool
     */
    private function isSpare($firstThrowBallInFrame):bool
    {
        return $this->ballThrows[$firstThrowBallInFrame] + $this->ballThrows[$firstThrowBallInFrame + 1] === 10;
    }

    /**
     * @param $firstThrowBallInFrame
     * @return int
     */
    private function pointsForSpare($firstThrowBallInFrame):int
    {
        return 10 + $this->ballThrows[$firstThrowBallInFrame + 2];
    }

    /**
     * @param $firstThrowBallInFrame
     * @return int
     */
    private function pointsForStandardFrame($firstThrowBallInFrame): int
    {
        return $this->ballThrows[$firstThrowBallInFrame] + $this->ballThrows[$firstThrowBallInFrame + 1];
    }

    /**
     * @param $firstThrowBallInFrame
     * @return bool
     */
    private function isStrike($firstThrowBallInFrame):bool
    {
        return $this->ballThrows[$firstThrowBallInFrame] === 10;
    }

    /**
     * @param $firstThrowBallInFrame
     * @return int
     */
    private function pointsForStrike($firstThrowBallInFrame):int
    {
        return 10 + $this->ballThrows[$firstThrowBallInFrame + 1] + $this->ballThrows[$firstThrowBallInFrame + 2];
    }
}
