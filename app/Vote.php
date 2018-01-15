<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = ['question'];

    public function voteOptions() {
      return $this->hasMany(VoteOption::class);
    }
    public function Active($query) {
      return $query->where('active', true);
    }
}
