<?php

namespace App\Http\Controllers;

use App\Vote;
use App\VoteOption;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function index() {
      return view('index');
    }
    public function show() {
      $stickyform = request()->stickyform('vote');
      $vote = Vote::with('voteOptions')->active()->first();
      return [
        'vote' => $vote->question,
        'options'=> $vote->voteOptions->map(function($item){
          return['id'=> $item->id, 'name'=> $item->name, 'totalVotes' =>$item->totalVotes];
        }),
        'isSticky' => $stickyform ? true : false

      ];
    }

    public function store(Request $request) {
      $id = $request->get('id');
      if ($id) {

        $optionSelected = VoteOption::findOrFail($id);
        $optionSelected->totalVotes += 1;
        $optionSelected->save();

        return response("Vote recorded")->stickyform('vote','yes',100);
      }
    }
}
