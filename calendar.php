<?php
 
class Calendar
{
 
    
    public function __construct()
    {
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
    }
 
    public $cellContent = '';
    protected $observers = array();
 
    private $dagar = array("Mån", "Tis", "Ons", "Tors", "Fre", "Lör", "Sön");
    private $nuvarandeÅr = 0;
    private $nuvarandeMånad = 0;
    private $nuvarandeDag = 0;
    private $nuvarandeDatum = null;
    private $dagarIMånad = 0;
    private $söndagFörst = true;
    private $naviHref = null;

    public function attachObserver($type, $observer)
    {
        $this->observers[$type][] = $observer;
    }
 
    public function notifyObserver($type)
    {
        if (isset($this->observers[$type])) {
            foreach ($this->observers[$type] as $observer) {
                $observer->update($this);
            }
        }
    }
 
    public function getCurrentDate()
    {
        return $this->nuvarandeDatum;
    }

    public function setSundayFirst($bool = true)
    {
        $this->söndagFörst = $bool;
    }
 

    public function show($month = null, $year = null, $attributes = false)
    {
        if (null == $year && isset($_GET['year'])) {
            $year = $_GET['year'];
        } else if (null == $year) {
            $year = date("Y", time());
        }
 
        if (null == $month && isset($_GET['month'])) {
            $month = $_GET['month'];
        } else if (null == $month) {
            $month = date("m", time());
        }
 
<<<<<<< HEAD
        $this->currentYear = $year;
        $this->currentMonth = $month;
        $this->daysInMonth = $this->_daysInMonth($month, $year);
        $date = $_POST['date'];

=======
        $this->nuvarandeÅr = $year;
        $this->nuvaradeMånad = $month;
        $this->dagarIMånad = $this->_daysInMonth($month, $year);
 
>>>>>>> 6940bc4f2be45abf95a7a3617ed4882205b2dc86
        $content = '<div id="calendar">' .
            '<div class="box">' .
            $this->_createNavi() .
            '</div>' .
            '<div class="box-content">' .
            '<ul class="label">' . $this->_createLabels() . '</ul>';

        $content .= '<div class="clear"></div>';
        $content .= '<ul class="dates">';
        for ($i = 0; $i < $this->_weeksInMonth($month, $year); $i++) {
            for ($j = 1; $j <= 7; $j++) {
                $content .= $this->_showDay($i * 7 + $j, $attributes);
                    

            }
        }
        $content .= '</ul>';
        $content .= '<div class="clear"></div>';
        $content .= '</div>';
        $content .= '</div>';
        return $content;
    }

    private function _showDay($cellNumber, $attributes = false)
    {
        if ($this->nuvarandeDag == 0) {

            $firstDayOfTheWeek = date('N', strtotime($this->nuvarandeÅr . '-' . $this->nuvaradeMånad . '-01'));
            if ($this->söndagFörst) {
                if ($firstDayOfTheWeek == 7) {
                    $firstDayOfTheWeek = 1;
                } else {
                    $firstDayOfTheWeek++;
                }
            }
            if (intval($cellNumber) == intval($firstDayOfTheWeek)) {
                $this->nuvarandeDag = 1;
            }
        }
 
        if (($this->nuvarandeDag != 0) && ($this->nuvarandeDag <= $this->dagarIMånad)) {
            $this->nuvarandeDatum = date('Y-m-d', strtotime($this->nuvarandeÅr . '-' . $this->nuvaradeMånad . '-' . ($this->nuvarandeDag)));
            $cellContent = $this->_createCellContent($attributes);
            $this->nuvarandeDag++;
        } else {
            $this->nuvarandeDatum = null;
            $cellContent = null;
        }
 
 
        return '<li id="li-' . $this->nuvarandeDatum . '" class="' . ($cellNumber % 7 == 1 ? ' start ' : ($cellNumber % 7 == 0 ? ' end ' : ' ')) .
            ($cellContent == null ? 'mask' : '') . '">' . $cellContent . '</li>';

    }
 

    private function _createNavi()
    {
        $nextMonth = $this->nuvaradeMånad == 12 ? 1 : intval($this->nuvaradeMånad) + 1;
        $nextYear = $this->nuvaradeMånad == 12 ? intval($this->nuvarandeÅr) + 1 : $this->nuvarandeår;
 
        $preMonth = $this->nuvaradeMånad == 1 ? 12 : intval($this->nuvaradeMånad) - 1;
        $preYear = $this->nuvaradeMånad == 1 ? intval($this->nuvarandeÅr) - 1 : $this->nuvarandeår;
 
        return
            '<div class="header">' .
            '<a class="prev" href="' . $this->naviHref . '?month=' . sprintf('%02d', $preMonth) . '&year=' . $preYear . '">Prev</a>' .
            '<span class="title">' . date('Y M', strtotime($this->nuvarandeÅr . '-' . $this->nuvaradeMånad . '-1')) . '</span>' .
            '<a class="next" href="' . $this->naviHref . '?month=' . sprintf("%02d", $nextMonth) . '&year=' . $nextYear . '">Next</a>' .
            '</div>';
    }
 

    private function _createLabels()
    {
        if ($this->söndagFörst) {
            $temp = $this->dagar[0];
            for ($i = 1; $i < sizeof($this->dagar); $i++) {
                $tmp = $this->dagar[$i];
                $this->dagar[$i] = $temp;
                $temp = $tmp;
            }
            $this->dagar[0] = $temp;
        }
 
 
        $content = '';
        foreach ($this->dagar as $index => $label) {
            $content .= '<li class="' . ($label == 6 ? 'end title' : 'start title') . ' title">' . $label . '</li>';
        }
 
        return $content;
    }
 
    
    private function _createCellContent($setting = false)
    {
        $this->cellContent = '';
 
<<<<<<< HEAD
        $this->cellContent = $this->currentDay;
       
=======
        $this->cellContent = $this->nuvarandeDag;
>>>>>>> 6940bc4f2be45abf95a7a3617ed4882205b2dc86
 

        $this->notifyObserver('showCell');
 
        return $this->cellContent;
    }
 
    
    private function _weeksInMonth($month = null, $year = null)
    {
        if (null == ($year))
            $year = date("Y", time());
 
        if (null == ($month))
            $month = date("m", time());
 
 
        $dagarIMånad = $this->_daysInMonth($month, $year);
 
        $numOfweeks = ($dagarIMånad % 7 == 0 ? 0 : 1) + intval($dagarIMånad / 7);
        $monthEndingDay = date('N', strtotime($year . '-' . $month . '-' . $dagarIMånad));
        $monthStartDay = date('N', strtotime($year . '-' . $month . '-01'));
        $monthEndingDay == 7 ? $monthEndingDay = 0 : '';
        $monthStartDay == 7 ? $monthStartDay = 0 : '';
 
        if ($monthEndingDay < $monthStartDay) {
            $numOfweeks++;
        }
        return $numOfweeks;
 
    }
 

    private function _daysInMonth($month = null, $year = null)
    {
        if (null == ($year))
            $year = date("Y", time());
 
        if (null == ($month))
            $month = date("m", time());
 
        return date('t', strtotime($year . '-' . $month . '-01'));
    }
 
}