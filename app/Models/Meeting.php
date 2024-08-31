<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'adoption_request_id',
        'meeting_date',
        'status',
    ];

    /**
     * Get the adoption request associated with the meeting.
     */
     public function adoptionRequest()
    {
        return $this->belongsTo(AdoptionRequest::class);
    }
}
