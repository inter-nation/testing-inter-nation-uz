<?php
/**
 * Created by PhpStorm.
 * User: Ziyovuddin
 * Date: 06.09.2017
 * Time: 17:00
 */
namespace app\components;

class TimeList
{
    const TIME_LIST=[
        730 => '7:30',
        900=> '9:00',
        1030=>'10:30',
        1200=>'12:00',
        1400=>'14:00',
        1530=>'15:30',
        1700=>'17:00',
        1830=>'18:30',
     //   2000=>'20:00',
    ];

    const OFFICE_HOURS=[
        1300=>'13:00',
        1330=>'13:30',
        1400=>'14:00',
        1430=>'14:30',
        1500=>'15:00',
        1530=>'15:30',
        1600=>'16:00',
        1630=>'16:30',
        1700=>'17:00',
        1730=>'17:30',
        1800=>'18:00',
        1830=>'18:30',
        1900=>'19:00',
        1930=>'19:30',
        2000=>'20:00',
    ];

    const DATE_LIST=[
        '0'=>'Mon,Wen,Fri',
        '1'=>'Tu,Thu,Sat',
    ];
    const DATE_LIST_ADMIN=[
        '0'=>'1,3,5',
        '1'=>'2,4,6',
    ];
    const RECEPTION_DATE_LIST=[
        2=>'Any Date',
        0=>'Mon,Wen,Fri',
        1=>'Tu,Thu,Sun',
    ];
    const RECEPTION_TIME_LIST=[
        730 => '7:30',
        900=> '9:00',
        1030=>'10:30',
        1200=>'12:00',
        1400=>'14:00',
        1530=>'15:30',
        1700=>'17:00',
        1830=>'18:30',
        self::ANY_TIME=>'Any Time'
    ];
    const ANY_TIME=0;

    public const FULL_MONTH_LIST = [
        '01' => 'January',
        '02' => 'February',
        '03' => 'March',
        '04' => 'April',
        '05' => 'May',
        '06' => 'June',
        '07' => 'July',
        '08' => 'August',
        '09' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December',
    ];
}