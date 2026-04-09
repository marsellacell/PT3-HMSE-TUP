<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proposal extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'background',
        'objective',
        'risk_level',
        'risk_description',
        'budget',
        'timeline',
        'file_path',
        'status',
        'rejection_reason',
    ];

    protected $casts = [
        'budget' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the user who created this proposal
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all approvals for this proposal
     */
    public function approvals(): HasMany
    {
        return $this->hasMany(ProposalApproval::class)->orderBy('approval_order');
    }

    /**
     * Check if proposal is approved by all required approvers
     */
    public function isFullyApproved(): bool
    {
        $approvals = $this->approvals;
        if ($approvals->isEmpty()) {
            return false;
        }
        return $approvals->every(fn($approval) => $approval->status === 'approved');
    }

    /**
     * Get next approver role that needs to approve
     */
    public function getNextApproverRole(): ?string
    {
        return $this->approvals()
            ->where('status', 'pending')
            ->orderBy('approval_order')
            ->first()
            ?->approver_role;
    }
}
