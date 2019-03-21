<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Player;
use App\Round;
use Input;

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

    public function profile(){

        $user_id = auth()->user()->id;
        $players = Player::where('user_id', $user_id)->get();
        return view('home')->with('players', $players);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
       $items = $request->get('item');
        //$items->name = $request->item;


        $options = array("rock", "paper", "scissors");
        $computer = $options[rand(0,2)];

        $game=new Player();
        $game->user_id = auth()->user()->id;
        $game->name= auth()->user()->name;
        $game->computer = $computer;
        $game->item = $items;
        //$game->save();

        //$game_id = $game->id;


        if($items == 'scissors' && $computer == 'paper' ||
            $items == 'paper' && $computer == 'rock' ||
            $items == 'rock' && $computer == 'scissors') :
            $game->win= 'Win';

            $round = new Round();
            $round->user_id = auth()->user()->id;
            $round->win = 'Win';
            $round->save();
            $result = Round::all('win');
          /*  if($result == 2){
                $game->victories = '1';
                $game->save();
            }*/
        endif;

        if($computer == 'scissors' && $items == 'paper' ||
            $computer == 'paper' && $items == 'rock' ||
            $computer == 'rock' && $items == 'scissors') :
            $game->win= 'Lost';

            $round = new Round();
            $round->user_id = auth()->user()->id;
            $round->win = 'Lost';
            $round->save();
        endif;

        if($items == $computer) :
            $game->win= 'Tie';
            $round = new Round();
            $round->user_id = auth()->user()->id;
            $round->win = 'Tie';
            $round->save();
        endif;
        $game->save();

        return view('resultView')->with('items', $items)->with( 'computer', $computer);
    }

    public function storeAjax(Request $request)
    {
       //return $request;
       //$items = $request->get('item');
        $items = $request->item;
        //dd($items);
        $options = array("rock", "paper", "scissors");
        $computer = $options[rand(0,2)];

        $game=new Player();
        $game->user_id = auth()->user()->id;
        $game->name= auth()->user()->name;
        $game->computer = $computer;
        //$game->item = $items;
        $game->item = $items;

        if($items == 'scissors' && $computer == 'paper' ||
            $items == 'paper' && $computer == 'rock' ||
            $items == 'rock' && $computer == 'scissors') :
            $game->win= 'Win';

            $round = new Round();
            $round->user_id = auth()->user()->id;
            $round->win = 'Win';
            $round->save();
            $game->save();
            return response()->json(['success'=>'You Win'], 200);
        endif;

        if($computer == 'scissors' && $items == 'paper' ||
            $computer == 'paper' && $items == 'rock' ||
            $computer == 'rock' && $items == 'scissors') :
            $game->win= 'Lost';

            $round = new Round();
            $round->user_id = auth()->user()->id;
            $round->win = 'Lost';
            $round->save();
            $game->save();
            return response()->json(['success'=>'You lost']);
        endif;

        if($items == $computer) :
            $game->win= 'Tie';
            $round = new Round();
            $round->user_id = auth()->user()->id;
            $round->win = 'Tie';
            $round->save();
            $game->save();
            return response()->json(['success'=>'Tie']);
        endif;
        //return response()->json(['success'=>'Data is successfully added']);
        //$game->save();
        //return $request;
        //return view('test')->with('items', $items)->with( 'computer', $computer);

    }

    public function userOptions(Request $request){
        $userItem = $request->get('item');
        //dd($items);
        return view('home')->with('userItem', $userItem);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $game = Player::find($id);
        return view('play')->with('player', $game);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
