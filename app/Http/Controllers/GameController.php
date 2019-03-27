<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Player;
use App\Round;
use Input;
use Session;
use DB;
use Auth;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $players = Player::orderBy('name', 'desc')take(5)->get();
        *
        * $players = Player::where('name', 'sasho')->get();
        * $players = DB::select(SELECT * FROM players);
        */
        $players = Player::orderBy('name', 'desc')->paginate(10);

        //$players = Player::all();
        return view('index')->with('players', $players);
    }

    public function gameover(){
        return view('gameover');
    }

    public function profile()
    {
        $user_id = auth()->user()->id;
        $players = Player::where('user_id', $user_id)->orderBy('id', 'desc')->paginate(10);
        return view('welcome')->with('players', $players);
    }

   public function rounds(){
        $user_id = auth()->user()->id;
        $rounds = Round::where('user_id', $user_id)->orderBy('id', 'desc')->paginate(10);
        return view('rounds')->with('rounds', $rounds);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('result');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $items = $request->get('name');
        }

        $options = array("rock", "paper", "scissors");
        $computer = $options[rand(0, 2)];

        $game = new Player();
        $game->user_id = auth()->user()->id;
        $game->name = auth()->user()->name;
        $game->computer = $computer;
        $game->item = $request->get('name');
        /*
         * if there is 3 rows in a table
         * check if there is more than 1 victories
         * set game as Win else set game as Lost
         */
        $count = Round::all();
        if($count->count() == 3){
            $game->save();
            Session::flash('success', 'Game Over');
            return view('welcome');
        }else{
            if ($items == 'scissors' && $computer == 'paper' ||
                $items == 'paper' && $computer == 'rock' ||
                $items == 'rock' && $computer == 'scissors') :
                $game->win = 'Win';
                Session::flash('success', 'You WIN.');
                $round = new Round();
                $round->user_id = auth()->user()->id;
                $round->win = 'Win';
                $round->victories = 1;
                $round->save();
            endif;

            if ($computer == 'scissors' && $items == 'paper' ||
                $computer == 'paper' && $items == 'rock' ||
                $computer == 'rock' && $items == 'scissors') :
                $game->win = 'Lost';
                Session::flash('success', 'You LOST.');
                $round = new Round();
                $round->user_id = auth()->user()->id;
                $round->win = 'Lost';
                $round->victories = 0;
                $round->save();
            endif;

            if ($items == $computer) :
                $game->win = 'Tie';
                Session::flash('success', 'TIE');
                $round = new Round();
                $round->user_id = auth()->user()->id;
                $round->win = 'Tie';
                $round->victories = 0;
                $round->save();
            endif;
        }

       $game->save();
        if ($request->isXmlHttpRequest()) {
                return response()->json([
                    'result' => $round->win
                ]);
            }
        //return view('welcome');
    }

    public function show($id)
    {
       /* $game = Player::find($id);
        return view('play')->with('player', $game);*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
