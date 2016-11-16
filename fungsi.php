<?php

function bulan($ke = null) {
    $bulan = array(
        1 => "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember",
    );
    if($ke != null) $bulan = $bulan[$ke];
    return $bulan;
}