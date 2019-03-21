<?php declare(strict_types=1);

namespace Tests\Calendar\Application;

use Calendar\Application\Calendar;
use PHPUnit\Framework\TestCase;

class CalendarTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider getData
     */
    public function executePass(string $date, string $day): void
    {
        $calendar = new Calendar(1, 1, 1990);

        $result = $calendar->getDayOfWeek($date);

        $this->assertEquals($day, $result);
    }

    public function getData(): array
    {
        return [
            ['01.01.1990', 'Monday'],
            ['02.01.1990', 'Tuesday'],
            ['03.01.1990', 'Wednesday'],
            ['04.01.1990', 'Thursday'],
            ['05.01.1990', 'Friday'],
            ['06.01.1990', 'Saturday'],
            ['07.01.1990', 'Sunday'],

            ['08.01.1990', 'Monday'],
            ['09.01.1990', 'Tuesday'],
            ['10.01.1990', 'Wednesday'],
            ['11.01.1990', 'Thursday'],
            ['12.01.1990', 'Friday'],
            ['13.01.1990', 'Saturday'],
            ['14.01.1990', 'Sunday'],
            ['01.11.1990', 'Saturday'],
            ['21.12.1990', 'Saturday'],
            ['01.13.1990', 'Sunday'],

            ['21.13.1990', 'Saturday'],
            ['19.09.1990', 'Tuesday'],
            ['15.07.1990', 'Thursday'],
            ['09.07.1991', 'Thursday'],
            ['16.13.2005', 'Friday'],
            ['17.13.2005', 'Saturday'],

            ['15.11.2013', 'Monday'],
            ['16.11.2013', 'Tuesday'],
            ['17.11.2013', 'Wednesday'],
            ['18.11.2013', 'Thursday'],
            ['19.11.2013', 'Friday'],
            ['20.11.2013', 'Saturday'],
            ['21.11.2013', 'Sunday'],

            ['20.12.1988', 'Friday'],
            ['21.12.1988', 'Saturday'],
            ['01.13.1988', 'Sunday'],
            ['02.13.1988', 'Monday'],

            ['01.01.1989', 'Monday'],
            ['22.01.1989', 'Monday'],
            ['01.02.1989', 'Tuesday'],
            ['21.2.1989', 'Monday'],
            ['22.3.1989', 'Tuesday'],
            ['10.13.1989', 'Tuesday'],

            ['22.13.1989', 'Sunday'],
            ['21.13.1989', 'Saturday'],
            ['20.13.1989', 'Friday'],

            ['02.11.1987', 'Sunday'],
            ['01.11.1987', 'Saturday'],

            ['14.2.1986', 'Monday'],
        ];
    }

    /**
     * @test
     *
     * @dataProvider getNotValidData
     */
    public function executeNotPass(string $date): void
    {
        $this->expectException(\RuntimeException::class);

        $calendar = new Calendar(1, 1, 1990);

        $calendar->getDayOfWeek($date);
    }

    public function getNotValidData(): array
    {
        return [
            ['test'],
            ['25'],
            ['25.11.2013'],
            ['24.13.1989'],
            ['24.17.1989'],
            ['test.17.1989'],
            ['12.test.1989'],
            ['12.12.test'],
        ];
    }
}
