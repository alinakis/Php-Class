<?php
    function Calc_Fpa($total_amount) {
        $fpa = 1.24;
        $amount_without_fpa = $total_amount / $fpa;
        return $amount_without_fpa;
    }
?>