<?php

function formatRupiah($nominal, $prefix = true)
{
    if ($prefix) {
        return "Rp. " . number_format($nominal, 0, ',', '.');
    }
    return number_format($nominal, 0, ',', '.');
}

?>