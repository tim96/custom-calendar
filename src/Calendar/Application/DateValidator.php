<?php declare(strict_types=1);

namespace Calendar\Application;

class DateValidator
{
    public function validate(string $date)
    {
        $data = explode('.', $date);
        if (\count($data) !== 3) {
            throw new \RuntimeException('Wrong date format. Should be: m.d.Y');
        }

        if (!is_numeric($data[0])) {
            throw new \RuntimeException('Wrong day of the date.');
        }

        if (!is_numeric($data[1])) {
            throw new \RuntimeException('Wrong month of the date.');
        }

        if (!is_numeric($data[2])) {
            throw new \RuntimeException('Wrong year of the date.');
        }

        $day = (int) $data[0];
        $month = (int) $data[1];
        $year = (int) $data[2];

        $isLeapYear = $this->isLeapYear($year);
        $isOddMonth = $this->isOddMonth($month);

        if ($month < 1 || $month > Calendar::COUNT_MONTHS) {
            throw new \RuntimeException('Wrong month number of the date.');
        }

        if ($isLeapYear && ($month === Calendar::COUNT_MONTHS)) {
            if ($day < 1 && $day > (Calendar::COUNT_DAYS_ODD_MONTH - 1)) {
                throw new \RuntimeException('Wrong day number of the date.');
            }
        } elseif ($isOddMonth) {
            if ($day < 1 || $day > Calendar::COUNT_DAYS_ODD_MONTH) {
                throw new \RuntimeException('Wrong day number of the date for odd month.');
            }
        } else {
            if ($day < 1 || $day > Calendar::COUNT_DAYS_EVEN_MONTH) {
                throw new \RuntimeException('Wrong day number of the date for even month.');
            }
        }
    }

    private function isLeapYear(int $year): bool
    {
        return ($year % Calendar::LEAP_YEAR === 0);
    }

    private function isOddMonth(int $month): bool
    {
        return ($month % 2 === 1);
    }
}
