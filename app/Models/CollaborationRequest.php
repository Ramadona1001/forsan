<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollaborationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'collaboration_id',
        'name',
        'email',
        'phone',
        'message',
    ];

    public function collaboration()
    {
        return $this->belongsTo(Collaboration::class);
    }
}
