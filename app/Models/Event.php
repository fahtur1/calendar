<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $keyType = 'string';

    protected $primaryKey = 'id_event';

    protected $fillable = [
        'id_event',
        'title',
        'start',
        'end',
        'description'
    ];
}
