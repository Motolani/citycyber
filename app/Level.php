<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
        protected $table = "levels";
	protected $fillable = [
             'title','required_doc_ids','salary'
		];
}
