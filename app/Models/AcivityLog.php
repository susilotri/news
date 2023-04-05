<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcivityLog extends Model
{
    use HasFactory;
    protected $table = 'activity_log';
    protected $fillable = [
        'news_id',
        'activity',
        'user',
    ];
}
