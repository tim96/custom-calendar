<?php declare(strict_types=1);

namespace Calendar\Application;

class Calendar
{
    public const COUNT_MONTHS = 13;
    public const LEAP_YEAR = 5;
    public const COUNT_DAYS_PER_WEEK = 7;
    public const COUNT_DAYS_ODD_MONTH = 22;
    public const COUNT_DAYS_EVEN_MONTH = 21;

    /**
     * @var int
     */
    private $initialDay;

    /**
     * @var int
     */
    private $initialMonth;

    /**
     * @var int
     */
    private $initialYear;

    /**
     * @var DateValidator
     */
    private $dateValidator;

    /**
     * @var DateTransformer
     */
    private $transform;

    public function __construct(int $initialDay, int $initialMonth, int $initialYear)
    {
        $this->initialDay = $initialDay;
        $this->initialMonth = $initialMonth;
        $this->initialYear = $initialYear;

        // Should be injected as interface in real project
        $this->dateValidator = new DateValidator();
        $this->transform = new DateTransformer();
    }

    public function getDayOfWeek(string $date): string
    {
        $date = trim($date);
        $this->dateValidator->validate($date);

        $data = explode('.', $date);
        $days = $this->getCountDaysBetweenDates((int) $data[0], (int) $data[1], (int) $data[2]);
        $number = $days % static::COUNT_DAYS_PER_WEEK;

        return $this->transform->transform($number);
    }

    private function getCountDaysBetweenDates(int $day, int $month, int $year): int
    {
        $days = 0;
        $days += $this->calculateDaysByYear($year);
        $days += $this->calculateDaysByMonth($month);
        $days += $this->calculateDays($day);

        return $days;
    }

    private function calculateDaysByYear(int $year): int
    {
        $days = 0;
        if ($this->initialYear < $year) {
            $start = $this->initialYear;
            $end = $year;
        } elseif ($this->initialYear > ($year + 1)) {
            $start = $year;
            $end = $this->initialYear;
        } else {
            return $days;
        }

        for ($i = $start; $i < $end; $i++) {
            $days += $this->calculateDaysByMonth(static::COUNT_MONTHS + 1);
            if ($this->isLeapYear($i)) {
                --$days;
            }
        }

        return $days;
    }

    private function calculateDaysByMonth(int $month): int
    {
        $days = 0;
        if ($this->initialMonth < $month) {
            for ($i = $this->initialMonth; $i < $month; $i++) {
                if ($this->isOddMonth($i)) {
                    $days += static::COUNT_DAYS_ODD_MONTH;
                } else {
                    $days += static::COUNT_DAYS_EVEN_MONTH;
                }
            }
        }

        return $days;
    }

    private function calculateDays(int $day): int
    {
        $days = 0;
        if ($this->initialDay < $day) {
            $days += ($day - $this->initialDay);
        }

        return $days;
    }

    private function isLeapYear(int $year): bool
    {
        return ($year % static::LEAP_YEAR === 0);
    }

    private function isOddMonth(int $month): bool
    {
        return ($month % 2 === 1);
    }
}
