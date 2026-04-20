<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramKerja extends Model
{
    protected $fillable = [
        'name',
        'division',
        'status',
        'pj_user_id',
        'date_start',
        'date_end',
        'description',
        'location',
        'target_participants',
        'progress',
        'color',
        'timeline',
        'documents',
        'budget_items',
        'committee_member_ids',
    ];

    protected $casts = [
        'date_start' => 'date',
        'date_end' => 'date',
        'timeline' => 'array',
        'documents' => 'array',
        'budget_items' => 'array',
        'committee_member_ids' => 'array',
    ];
}
