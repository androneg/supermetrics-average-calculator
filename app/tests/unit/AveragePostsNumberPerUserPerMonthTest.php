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


class AveragePostsNumberPerUserPerMonthTest extends TestCase
{

    /**
     * @dataProvider averagePerUserPerMonthTestProvider
     */
    public function testPerUserPerMonthAverage(array $inputArray, StatisticsTo $expected): void
    {


        $averagePerUserPerMonth = new AveragePostsNumberPerUserPerMonth();
        $paramsTo = new ParamsTo();
        $paramsTo->setStartDate((new DateTime())->sub(new DateInterval('P4M')));
        $paramsTo->setStatName("average-posts-per-user-per-month");
        $averagePerUserPerMonth->setParameters($paramsTo);



        foreach($inputArray as $input)
        {

            $averagePerUserPerMonth->accumulateData($input);
        }
        $this->assertSame($averagePerUserPerMonth->calculate()->getValue(), $expected->getValue());
    }

    /**
     * @return array[]
     */
    #[ArrayShape(['2-users-3-post-2month' => "array", '4-users-13-post-2-month' => "array", 'noUsers' => "array"])] public function averagePerUserPerMonthTestProvider() : array
    {
        return [
            '2-users-3-post-2month' => [
                [
                    (new SocialPostTo())->setAuthorId(1)->setDate(new DateTime('2022-12-20 12:02:00')),
                    (new SocialPostTo())->setAuthorId(2)->setDate(new DateTime('2022-12-18 18:12:00')),
                    (new SocialPostTo())->setAuthorId(1)->setDate(new DateTime('2022-11-15 16:25:00'))
                ],
                (new StatisticsTo())->setValue(0.75)
            ],

            '4-users-13-post-2-month' => [
                [
                    (new SocialPostTo())->setAuthorId(1)->setDate(new DateTime('2022-12-20 12:02:00')),
                    (new SocialPostTo())->setAuthorId(2)->setDate(new DateTime('2022-11-20 12:02:00')),
                    (new SocialPostTo())->setAuthorId(3)->setDate(new DateTime('2022-12-20 12:02:00')),
                    (new SocialPostTo())->setAuthorId(2)->setDate(new DateTime('2022-12-20 12:02:00')),
                    (new SocialPostTo())->setAuthorId(1)->setDate(new DateTime('2022-12-20 12:02:00')),
                    (new SocialPostTo())->setAuthorId(2)->setDate(new DateTime('2022-12-20 12:02:00')),
                    (new SocialPostTo())->setAuthorId(3)->setDate(new DateTime('2022-11-20 12:02:00')),
                    (new SocialPostTo())->setAuthorId(2)->setDate(new DateTime('2022-12-20 12:02:00')),
                    (new SocialPostTo())->setAuthorId(1)->setDate(new DateTime('2022-12-20 12:02:00')),
                    (new SocialPostTo())->setAuthorId(3)->setDate(new DateTime('2022-11-20 12:02:00')),
                    (new SocialPostTo())->setAuthorId(4)->setDate(new DateTime('2022-12-20 12:02:00')),
                    (new SocialPostTo())->setAuthorId(1)->setDate(new DateTime('2022-11-20 12:02:00')),
                    (new SocialPostTo())->setAuthorId(4)->setDate(new DateTime('2022-12-20 12:02:00'))
                ],
                (new StatisticsTo())->setValue(1.625)
            ],

            'noUsers' => [
                [], (new StatisticsTo())->setValue(0)
            ]
        ];
    }

}
