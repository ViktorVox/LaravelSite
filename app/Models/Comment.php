<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body', 'candidate_id'];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
