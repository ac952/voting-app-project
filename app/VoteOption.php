<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteOption extends Model
{
    protected $table = ['name','totalVotes'];

    public function vote() {
      return $this->belongsTo(Vote::class);
    }
}
