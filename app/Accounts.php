<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    protected $table = 'accounts';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
