<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Sqits\UserStamps\Concerns\HasUserStamps;

class MonyStock extends Model
{
      use Translatable;
       use HasUserStamps;
       use SoftDeletes;

    protected $guarded = [];
    public $translatedAttributes = ['name'];

}
