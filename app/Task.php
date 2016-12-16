<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  /*
  public function user() {
      # Book belongs to Author
      # Define an inverse one-to-many relationship.
      return $this->belongsTo('App\User');
      }
      */

      public function users()
  {
      # With timetsamps() will ensure the pivot table has its created_at/updated_at fields automatically maintained
      return $this->belongsToMany('App\User')->withTimestamps();
  }
}
