<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
     /**
      * table from players
      * @var
      */
     protected $table = 'players';

     /**
      * guard id, created_at and updated_at
      * protection for mass assignment vulnerability.
      * @var
      */
     protected $guarded = ['id', 'created_at', 'updated_at'];
     /**
      * put $dates in to Carbon instances for date mutation.
      * @var
      */
     protected $dates = ['created_at', 'updated_at'];

}
