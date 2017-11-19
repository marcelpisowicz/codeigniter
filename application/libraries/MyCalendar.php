<?php

class MyCalendar
{
    private $weekDayName = array("MON", "TUE", "WED", "THU", "FRI", "SAT", "SUN");
    private $currentDay = 0;
    private $currentMonth = 0;
    private $currentYear = 0;
    private $currentMonthStart = null;
    private $currentMonthDaysLength = null;

    function __construct($year = null, $month = null)
    {
        $this->currentYear = date("Y", time());
        $this->currentMonth = date("m", time());

        if (!empty ($year)) {
            $this->currentYear = (int)$year;
        }
        if (!empty ($month)) {
            $this->currentMonth = (int)$month;
        }
        $this->currentMonthStart = $this->currentYear . '-' . $this->currentMonth . '-01';
        $this->currentMonthDaysLength = date('t', strtotime($this->currentMonthStart));
    }

    function getCalendarHTML()
    {
        return '<div class="calendar-outer">'.$this->getCalendarTable().'</div>';
    }

    function getCalendarTable()
    {
        $prevMonthYear = date('m,Y', strtotime($this->currentMonthStart . ' -1 Month'));
        $prevMonthYearArray = explode(",", $prevMonthYear);

        $nextMonthYear = date('m,Y', strtotime($this->currentMonthStart . ' +1 Month'));
        $nextMonthYearArray = explode(",", $nextMonthYear);

        $calendarTable = '<table class="calendar_table datatable"><thead>'
            .'<tr><th><div class="prev" data-prev-month="' . $prevMonthYearArray[0] . '" data-prev-year = "' . $prevMonthYearArray[1] . '"><</div></th>'
            .'<th colspan="5"><span id="currentMonth">' . date('M', strtotime($this->currentMonthStart)) . '</span>'
            .'<span contenteditable="true" id="currentYear" style="margin-left:5px">' . date('Y', strtotime($this->currentMonthStart)) . '</span></th>'
            .'<th></td><div class="next" data-next-month="' . $nextMonthYearArray[0] . '" data-next-year = "' . $nextMonthYearArray[1] . '">></div></th></tr>';


        foreach ($this->weekDayName as $dayname) {
            $calendarTable .= '<th>' . $dayname . '</th>';
        }
        $calendarTable .= '<tr></thead><tbody>';

        $weekLength = $this->getWeekLengthByMonth();
        $firstDayOfTheWeek = date('N', strtotime($this->currentMonthStart));

        for ($i = 0; $i < $weekLength; $i++) {
            $calendarTable .= '<tr>';
            for ($j = 1; $j <= 7; $j++) {
                $cellIndex = $i * 7 + $j;
                $cellValue = null;
                if ($cellIndex == $firstDayOfTheWeek) {
                    $this->currentDay = 1;
                }
                if (!empty ($this->currentDay) && $this->currentDay <= $this->currentMonthDaysLength) {
                    $cellValue = $this->currentDay;
                    $this->currentDay++;
                }
                if(!empty($cellValue)) {
                    $calendarTable .= '<td>';
                } else {
                    $calendarTable .= '<td class="td_disabled">';
                }
                $calendarTable .= $cellValue . '</td>';
            }
            $calendarTable .= '</tr>';
        }
        return $calendarTable.'</tbody></table>';
    }

    function getWeekLengthByMonth()
    {
        $weekLength = intval($this->currentMonthDaysLength / 7);
        if ($this->currentMonthDaysLength % 7 > 0) {
            $weekLength++;
        }
        $monthStartDay = date('N', strtotime($this->currentMonthStart));
        $monthEndingDay = date('N', strtotime($this->currentYear . '-' . $this->currentMonth . '-' . $this->currentMonthDaysLength));
        if ($monthEndingDay < $monthStartDay) {
            $weekLength++;
        }

        return $weekLength;
    }
}
