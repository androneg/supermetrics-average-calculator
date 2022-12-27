# Statistic Calculator & Unit Tests


##### Table of Contents
- [Change Log](#change-log)

- [Average number of posts per user in a given month](#per-user-given-month)

- [Average Posts Number Per User Per Month](#per-user-per-month)

- [Test Cases](#test-cases)


## Change Log


- Added constant in app/module/App/src/Controller/StatisticsController.php
    - StatsEnum::AVERAGE_POST_NUMBER_PER_USER_PER_MONTH   => 'Average Posts Number Per User Per Month'


- Two class has been added
  - app/module/Statistics/src/Calculator/AveragePostNumberPerUser.php
  - app/module/Statistics/src/Calculator/AveragePostsNumberPerUserPerMonth.php


- Added two constants in app/module/Statistics/src/Enum/StatsEnum.php Class
  - public const AVERAGE_POST_NUMBER_PER_USER = 'average-posts-per-user'
  - public const AVERAGE_POST_NUMBER_PER_USER_PER_MONTH = 'average-posts-per-user-per-month';

- 'StatsEnum::AVERAGE_POST_NUMBER_PER_USER' has been added in app/module/Statistics/src/Calculator/Factory/StatisticsCalculatorFactory.php
- 'StatsEnum::AVERAGE_POST_NUMBER_PER_USER_PER_MONTH' has been added in app/module/Statistics/src/Calculator/Factory/StatisticsCalculatorFactory.php


- Added first and last day of 6 months period in app/module/Statistics/src/Builder/ParamsBuilder.php which used in AveragePostsNumberPerUserPerMonth class
  - $averageStartDate = (clone $date)->modify('first day of July 2022')->setTime(0, 0, 0);
  - $averageEndDate   = (clone $date)->modify('last day of December 2022')->setTime(23, 59, 59);


- Added README file: app/module/Statistics/src/Calculator/README.md

## Average number of posts per user in a given month
file name: app/module/Statistics/src/Calculator/AveragePostNumberPerUser.php
Calculated average number of posts per use by a given month from UI


## Average Posts Number Per User Per Month
filename: app/module/Statistics/src/Calculator/AveragePostsNumberPerUserPerMonth.php
Calculated Average number of all posts (during 6 month) per user per month


## Test Cases

- Two unit test cased have been added
  - app/tests/unit/AveragePostNumberPerUserTest.php
  - app/tests/unit/AveragePostsNumberPerUserPerMonthTest.php

