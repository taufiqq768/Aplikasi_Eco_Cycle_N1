<?php

namespace App\Enum;

enum KategoriPemakaianSumberDaya: string
{
    case AIR = 'Air';
    case LISTRIK = 'Listrik';
    case BBM = 'BBM';
    case PELUMAS = 'Pelumas';
    case LIMBAH_PADAT = 'Limbah Padat';
    case LIMBAH_B3 = 'Limbah B3';
}
