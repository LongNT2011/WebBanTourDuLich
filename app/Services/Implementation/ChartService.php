<?php
class ChartService implements IChartService {
    private $previousMonth;
    private $previousMonthStartDate;
    private $currentMonthStartDate;

    public function __construct()
    {
        $this->previousMonth = date('m') == '01' ? '12' : (date('m') - 1);
        $this->previousMonthStartDate = new DateTime(date('Y') . '-' . $this->previousMonth . '-01');
        $this->currentMonthStartDate = new DateTime(date('Y-m') . '-01');
    }
}
?>