<?php
/**
 * Created by PhpStorm.
 * User: ugur
 * Date: 2-12-17
 * Time: 23:54
 */

namespace App\Http\Controllers;

use App\Models\Reviews;
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


    }

}