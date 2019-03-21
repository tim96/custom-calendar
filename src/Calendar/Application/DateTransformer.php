<?php declare(strict_types=1);

namespace Calendar\Application;

class DateTransformer
{
    public function transform(int $number)
    {
        switch ($number) {
            case 0:
                return 'Monday';
                break;
            case 1:
                return 'Tuesday';
                break;
            case 2:
                return 'Wednesday';
                break;
            case 3:
                return 'Thursday';
                break;
            case 4:
                return 'Friday';
                break;
            case 5:
                return 'Saturday';
                break;
            case 6:
                return 'Sunday';
                break;
            default:
                throw new \RuntimeException('Wrong number');
        }
    }
}
