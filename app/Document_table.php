<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Document_table extends Model
{
        protected $table = "document_tables";
	
	protected $fillable = [
            'name'
		];
}
