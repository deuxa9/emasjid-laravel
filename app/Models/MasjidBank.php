<?php

namespace App\Models;

use App\Traits\HasMasjid;
use App\Traits\HasCreatedBy;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ConvertContentImageBase64ToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasjidBank extends Model
{
    use HasFactory;

    use HasCreatedBy, HasMasjid;
    use ConvertContentImageBase64ToUrl;

    protected $guarded = [];
}
