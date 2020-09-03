<?php

namespace App\Http\Controllers;

use App\Option;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Vote;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function send(Request $request)
    {
        $vote = User::find(Auth::id());
        $vote->voted = true;
        $vote->save();
        DB::table('votes')
            ->where('option_id', $request->post('picked'))
            ->update([
                'votes_count' => DB::raw('votes_count + 1')
            ]);
        return response()->json(['success'=>true, 'status'=>200, 'user'=> Auth::id()]);
    }

    public function voted()
    {
        $voted = User::find(Auth::id())->get('voted');

        return response()->json(['success'=>true, 'status'=>200, 'voted' => $voted[0]['voted']]);
    }

    public function options()
    {
        $options = Option::all();
        return response()->json(['success'=>true, 'status'=>200, 'options'=> $options]);
    }

    public static function percentageOf($number, $sum, $decimals = 2 ){
        return  round($number / $sum * 100, $decimals);

    }

    public function user_votes()
    {
        $votes_count = Vote::with('options')->get();
        $votes = DB::SELECT('select options.name, votes.votes_count from options left join votes on options.id = votes.option_id');

        $sum = $votes_count->sum('votes_count');
        foreach( $votes as $key => $value) {
            $result[] =  array('name'=> $value->name, 'value'=> intval(self::percentageOf( $value->votes_count, $sum)));
        }

       return response()->json(['success'=>true, 'status'=>200, 'votes'=> $result]);
    }
}
