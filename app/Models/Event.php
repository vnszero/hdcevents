<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $casts = [
        'items' => 'array'
    ];

    protected $dates = ['date'];

    protected $guarded = [];

    public function guests() {
        return $this->belongsToMany('App\Models\User');
    }

    public function user() {
        return $this->belongsTo('APP\Models\User');
    }
}
