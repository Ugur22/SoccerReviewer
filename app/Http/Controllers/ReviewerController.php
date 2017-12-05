<?php
/**
 * Created by PhpStorm.
 * User: ugur
 * Date: 2-12-17
 * Time: 23:54
 */

namespace App\Http\Controllers;

use App\Models\Reviews;
use App\Models\Players;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class ReviewerController
{
    public function index()
    {

        $reviews = Reviews::all();


        if (empty($reviews)) {
            throw new ModelNotFoundException();
        }

        return response()->json($reviews);
    }

    public function getReview($id)
    {

        $review = Reviews::find($id);

        if (empty($review)) {
            throw new ModelNotFoundException();
        }

        return response()->json($review);
    }

    public function createReview()
    {

        $review = new Reviews();
        $review->speed = Input::get('speed');
        $review->passing = Input::get('passing');
        $review->shooting = Input::get('shooting');
        $review->teamwork = Input::get('teamwork');
        $review->defence = Input::get('defence');
        $review->stamina = Input::get('stamina');
        $review->keeper = Input::get('keeper');
        $review->overall = ($review->speed + $review->passing + $review->shooting + $review->teamwork + $review->defence + $review->stamina + $review->keeper) / 7;
        $review->player_id = Input::get('player_id');
        $review->reviewer_id = Input::get('reviewer_id');
        $review->save();

        $reviews = DB::table('reviews')->where('player_id', Input::get('player_id'))->get();


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


        $player = Players::find(Input::get('player_id'));
        $player->Speed = $speed / count($reviews);
        $player->passing = $passing / count($reviews);
        $player->Shooting = $Shooting / count($reviews);
        $player->Teamwork = $Teamwork / count($reviews);
        $player->Defence = $Defence / count($reviews);
        $player->Stamina = $Stamina / count($reviews);
        $player->Keeper = $Keeper / count($reviews);
        $player->total = $total / 7;
        $player->save();


    }

}