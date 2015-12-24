<?php

namespace RYP;

use Illuminate\Database\Eloquent\Model;

class Athlete extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'athlete';
	protected $fillable = ['name'];
}
