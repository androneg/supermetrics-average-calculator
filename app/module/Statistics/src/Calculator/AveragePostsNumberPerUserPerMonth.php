<?php

namespace Statistics\Calculator;

use SocialPost\Dto\SocialPostTo;
use Statistics\Dto\StatisticsTo;

class AveragePostsNumberPerUserPerMonth extends AbstractCalculator
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
    private array   $uniqueMonths = [];

    /**
     * @var array
     * Unique users array
     */
    private array   $uniqueUsers = [];


    /**
     * @param SocialPostTo $postTo
     * @return void
     */
    protected function doAccumulate(SocialPostTo $postTo): void
    {
        $author = $postTo->getAuthorId();
        $month = date_format($postTo->getDate(), "M");

        if(!in_array($month, $this->uniqueMonths))
        {
            $this->uniqueMonths[] = $month;
        }

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
        $monthCount = count($this->uniqueMonths);
        $averageNumber = $usersCount > 0 && $monthCount > 0 ? $this->totalPosts / $monthCount / $usersCount : 0;
        return (new StatisticsTo())->setValue($averageNumber);
    }
}
