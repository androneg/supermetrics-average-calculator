<?php

namespace Tests\unit;
namespace Statistics\Calculator;

use JetBrains\PhpStorm\ArrayShape;
use PHPUnit\Framework\TestCase;
use SocialPost\Dto\SocialPostTo;
use Statistics\Dto\ParamsTo;
use Statistics\Dto\StatisticsTo;
use DateTime;
use DateInterval;

class AveragePostNumberPerUserTest extends TestCase
{

    /**
     * @test
     */

    /**
     * @dataProvider averageTestProvider
     */
    public function testAverage(array $inputArray, StatisticsTo $expected): void
    {
        $average = new AveragePostNumberPerUser();
        $paramsTo = new  ParamsTo();
        $paramsTo->setStartDate((new DateTime())->sub(new DateInterval('P1D')));
        $paramsTo->setStatName("average-posts-per-user");
        $average->setParameters($paramsTo);
        foreach($inputArray as $input) {
            $average->accumulateData($input);
        }
        $this->assertSame($average->calculate()->getValue(), $expected->getValue());
    }


    #[ArrayShape(['2-users-3-post' => "array", '3-users-6-post' => "array", 'noUsers' => "array"])] public function averageTestProvider() : array
    {
        return [
            '2-users-3-post' => [
                    [
                        (new SocialPostTo())->setAuthorId(1)->setDate(new DateTime()),
                        (new SocialPostTo())->setAuthorId(2)->setDate(new DateTime()),
                        (new SocialPostTo())->setAuthorId(1)->setDate(new DateTime())
                    ],
                    (new StatisticsTo())->setValue(1.5)
            ],

            '3-users-6-post' => [
                [
                    (new SocialPostTo())->setAuthorId(1)->setDate(new DateTime()),
                    (new SocialPostTo())->setAuthorId(2)->setDate(new DateTime()),
                    (new SocialPostTo())->setAuthorId(3)->setDate(new DateTime()),
                    (new SocialPostTo())->setAuthorId(2)->setDate(new DateTime()),
                    (new SocialPostTo())->setAuthorId(1)->setDate(new DateTime()),
                    (new SocialPostTo())->setAuthorId(3)->setDate(new DateTime())
                ],
                (new StatisticsTo())->setValue(2)
            ],


            'noUsers' => [
                [], (new StatisticsTo())->setValue(0)
            ]
        ];
    }
}
