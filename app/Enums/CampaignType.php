<?php

namespace App\Enums;

enum CampaignType: string
{
    case KEMANUSIAAN = 'kemanusiaan';
    case KESEHATAN = 'kesehatan';
    case PENDIDIKAN = 'pendidikan';
    case TANGGAP_BENCANA = 'tanggap_bencana';
}