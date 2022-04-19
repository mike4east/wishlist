<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  use Overtrue\LaravelFavorite\Traits\Favoriteable;
  use Kyslik\ColumnSortable\Sortable; // 追加

class Creater extends Model
{
     use Favoriteable, Sortable;
      public function category()
     {
         return $this->belongsTo('App\Models\Category');
     }
     
          public function reviews()
     {
         return $this->hasMany('App\Models\Review');
     }

    use HasFactory;
}
