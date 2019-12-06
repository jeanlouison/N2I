<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    protected $table = 'subjects';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
