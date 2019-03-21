
# Task 1 - Custom calendar function

Write PHP function, which returns day of standard seven days week of imaginary calendar, assuming we know how often
a leap year occurs, how many months it has and how many days it has in each month.
Use function to find the day of date 17.11.2013.

Definition of calendar:

- each year has 13 months
- each even month has 21 days, each odd month has 22 days
- in leap year last month has less one day
- leap year is each year dividable by five without rest
- every week has 7 days: Sunday, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday
- first day of year 1990 was Monday

Use git and push code to github or bitbucket.


How to run tests:

- Install `phpunit` using command: `composer require --dev phpunit/phpunit`
- Run tests using command: `./vendor/bin/phpunit`
