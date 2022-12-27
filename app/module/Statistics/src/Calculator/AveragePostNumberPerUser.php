<?php

namespace Statistics\Calculator;

use SocialPost\Dto\SocialPostTo;
use Statistics\Dto\StatisticsTo;

class AveragePostNumberPerUser extends AbstractCalculator
{

    protected const UNITS = 'posts';

    /**
     * @var int
     * Total posts count
     */
    private int     $totalPosts = 0;

    /**
     * @var array
     * Unique month array
     */
    private array   $uniqueUsers = [];

    /**
     * @param SocialPostTo $postTo
     * @return void
     */
    protected function doAccumulate(SocialPostTo $postTo): void
    {
        $author = $postTo->getAuthorId();
        if(!in_array($author, $this->uniqueUsers))
        {
            $this->uniqueUsers[] = $author;
        }
        $this->totalPosts++;
    }

    /**
     * @param void
     * @return StatisticsTo
     */
    protected function doCalculate(): StatisticsTo
    {
        $usersCount = count($this->uniqueUsers);
        $averageNumber = $usersCount > 0 ? $this->totalPosts / $usersCount : 0;
        return (new StatisticsTo())->setValue($averageNumber);
    }
}
