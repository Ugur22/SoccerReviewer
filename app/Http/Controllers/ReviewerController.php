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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ReviewerController
{


    public function updatePlayerScores()
    {
        $reviews = DB::table('reviews')->where('player_id', Input::get('player_id'))->get();


        $speed = 0;
        $passing = 0;
        $shooting = 0;
        $teamwork = 0;
        $defence = 0;
        $stamina = 0;
        $keeper = 0;
        $total = 0;


        foreach ($reviews as $review) {
            $speed += $review->speed;
            $passing += $review->passing;
            $shooting += $review->shooting;
            $teamwork += $review->teamwork;
            $defence += $review->defence;
            $stamina += $review->stamina;
            $keeper += $review->keeper;
        }


        $playerObject = (object)[];
        $playerObject->speedAverage = $speed / count($reviews);
        $playerObject->passingAverage = $passing / count($reviews);
        $playerObject->ShootingAverage = $shooting / count($reviews);
        $playerObject->TeamworkAverage = $teamwork / count($reviews);
        $playerObject->DefenceAverage = $defence / count($reviews);
        $playerObject->StaminaAverage = $stamina / count($reviews);
        $playerObject->KeeperAverage = $keeper / count($reviews);

        foreach ($playerObject as $item) {
            $total += $item;
        }


        $playerObject->totalAverage = $total / 7;


        $player = Players::find(Input::get('player_id'));
        $player->speed = $speed / count($reviews);
        $player->passing = $passing / count($reviews);
        $player->shooting = $shooting / count($reviews);
        $player->teamwork = $teamwork / count($reviews);
        $player->defence = $defence / count($reviews);
        $player->stamina = $stamina / count($reviews);
        $player->keeper = $keeper / count($reviews);
        $player->total = $total / 7;
        $player->save();

    }


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

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function createReview()
    {


        $reviewCheck = Reviews::where([
            'player_id' => Input::get('player_id'),
            'reviewer_id' => Input::get('reviewer_id')
        ])->get();


        if (count($reviewCheck) > 0) {

            return response()->json(['status' => 'fail']);

        }
            $review = new Reviews();
            $review->speed = Input::get('speed');
            $review->passing = Input::get('passing');
            $review->shooting = Input::get('shooting');
            $review->teamwork = Input::get('teamwork');
            $review->defence = Input::get('defence');
            $review->stamina = Input::get('stamina');
            $review->keeper = Input::get('keeper');
            $review->reviewer_id = Input::get('reviewer_id');
            $review->player_id = Input::get('player_id');
            $review->overall = ($review->speed + $review->passing + $review->shooting + $review->teamwork + $review->defence + $review->stamina + $review->keeper) / 7;
            $review->save();
            self::updatePlayerScores();

        return response()->json($review);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteReview($id)
    {
        $review = Reviews::find($id);

        if (empty($review)) {
            throw new ModelNotFoundException();
        }
        $review->delete();
        return response()->json($review);

    }


    public function updateReview(Request $request, $id)
    {
        $review = Reviews::find($id);
        $review->speed = $request->input('speed');
        $review->passing = $request->input('passing');
        $review->shooting = $request->input('shooting');
        $review->teamwork = $request->input('teamwork');
        $review->defence = $request->input('defence');
        $review->stamina = $request->input('stamina');
        $review->keeper = $request->input('keeper');
        $review->player_id = Input::get('player_id');
        $review->reviewer_id = Input::get('reviewer_id');
        $review->overall = ($review->speed + $review->passing + $review->shooting + $review->teamwork + $review->defence + $review->stamina + $review->keeper) / 7;
        $review->save();

        self::updatePlayerScores();
        return response()->json($review);
    }

}