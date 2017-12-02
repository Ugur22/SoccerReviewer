<?php
/**
 * Created by PhpStorm.
 * User: ugur
 * Date: 2-12-17
 * Time: 23:54
 */

namespace App\Http\Controllers;

use App\Models\Reviews;

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

}