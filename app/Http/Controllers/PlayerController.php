<?php

namespace App\Http\Controllers;

use App\Models\Players;
use App\Models\Reviews;
use Illuminate\Support\Facades\DB;
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

        $reviews = DB::table('reviews')->where('player_id', $id)->get();


        $speed = 0;
        $passing = 0;
        $Shooting = 0;
        $Teamwork = 0;
        $Defence = 0;
        $Stamina = 0;
        $Keeper = 0;
        $total = 0;


        foreach ($reviews as $review) {
            $speed += $review->speed;
            $passing += $review->passing;
            $Shooting += $review->shooting;
            $Teamwork += $review->teamwork;
            $Defence += $review->defence;
            $Stamina += $review->stamina;
            $Keeper += $review->keeper;
        }
        $playerObject = (object)[];
        $playerObject->speedAverage = $speed / count($reviews);
        $playerObject->passingAverage = $passing / count($reviews);
        $playerObject->ShootingAverage = $Shooting / count($reviews);
        $playerObject->TeamworkAverage = $Teamwork / count($reviews);
        $playerObject->DefenceAverage = $Defence / count($reviews);
        $playerObject->StaminaAverage = $Stamina / count($reviews);
        $playerObject->KeeperAverage = $Keeper / count($reviews);

        foreach ($playerObject as $item) {
            $total += $item;
        }


        $playerObject->totalAverage = $total / 7;


        $player = Players::find($id);
        $player->Speed = $speed / count($reviews);
        $player->passing = $passing / count($reviews);
        $player->Shooting = $Shooting / count($reviews);
        $player->Teamwork = $Teamwork / count($reviews);
        $player->Defence = $Defence / count($reviews);
        $player->Stamina = $Stamina / count($reviews);
        $player->Keeper = $Keeper / count($reviews);
        $player->total = $total / 7;
        $player->save();


        $playerId = Players::find($id);

        if (empty($player)) {
            throw new ModelNotFoundException();
        }

        return response()->json($playerId);
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
    public function deletePlayer($id)
    {
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
     * @param int $id
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
