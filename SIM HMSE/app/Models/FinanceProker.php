<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceProker extends Model
{
    protected $guarded = [];
    protected $fillable = ['title', 'type', 'amount', 'date', 'description'];
}
