<?php

namespace App\Http\Controllers;

use App\Models\Players;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;


class PlayerController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
    }

    public function show()
    {

        return 'RESTful API';
    }

    public function index()
    {

        $players = Players::all();


        if (empty($players)) {
            throw new ModelNotFoundException();
        }

        return response()->json($players);
    }

    public function getPlayer($id)
    {

        $player = Players::find($id);

        if (empty($player)) {
            throw new ModelNotFoundException();
        }

        return response()->json($player);
    }

    public function createPlayer(Request $request)
    {
        $player = Players::create($request->all());
        return response()->json($player);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function  deletePlayer($id){
        $player = Players::find($id);

        if (empty($player)) {
            throw new ModelNotFoundException();
        }
        $player->delete();
        return response()->json($player);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePlayer(Request $request, $id)
    {
        $player = Players::find($id);
        $player->name = $request->input('name');
        $player->Speed = $request->input('Speed');
        $player->passing = $request->input('passing');
        $player->Shooting = $request->input('Shooting');
        $player->Teamwork = $request->input('Teamwork');
        $player->Defence = $request->input('Defence');
        $player->Stamina = $request->input('Stamina');
        $player->Keeper = $request->input('Keeper');
        $player->total = $request->input('total');
        $player->save();
        return response()->json($player);
    }

}
