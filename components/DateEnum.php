<?php
/**
 * Created by PhpStorm.
 * User: Ziyovuddin
 * Date: 09.09.2017
 * Time: 11:36
 */
namespace app\components;


class DateEnum
{
    const ODD = 0;
    const EVEN = 1;
    const ANY_DATE = 2;

    const MONDAY = 1;
    const TUESDAY = 2;
    const WEDNESDAY = 3;
    const THURSDAY = 4;
    const FRIDAY = 5;
    const SATURDAY = 6;
    const SUNDAY = 0;

    const ODD_DAYS = [
        self::MONDAY,
        self::WEDNESDAY,
        self::FRIDAY
    ];

    const EVEN_DAYS = [
        self::TUESDAY,
        self::THURSDAY,
        self::SATURDAY
    ];

    const WORKING_DAYS = [
        self::SUNDAY => 'Sunday',
        self::MONDAY => "Monday",
        self::WEDNESDAY => "Wednesday",
        self::FRIDAY => "Friday",
        self::TUESDAY => "Tuesday",
        self::THURSDAY => "Thursday",
        self::SATURDAY => "Saturday"
    ];

    const MONTH_LIST = [
        'January' => '01',
        'February' => '02',
        'March' => '03',
        'April' => '04',
        'May' => '05',
        'June' => '06',
        'July' => '07',
        'August' => '08',
        'September' => '09',
        'October' => '10',
        'November' => '11',
        'December' => '12'
    ];
    const SHORT_MONTH_LIST = [
        'Jan' => '01',
        'Feb' => '02',
        'Mar' => '03',
        'Apr' => '04',
        'May' => '05',
        'Jun' => '06',
        'Jul' => '07',
        'Aug' => '08',
        'Sep' => '09',
        'Oct' => '10',
        'Nov' => '11',
        'Dec' => '12'
    ];

    public static function yearList($minus=3,$plus=10)
    {
        $years = [];
        $currentYear = (int)date('Y');
        for ($i=($currentYear-$minus);$i<=($currentYear+$plus);$i++){
            $years[$i]=$i;
        }
        return $years;
    }

}