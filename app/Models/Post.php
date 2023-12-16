<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable=['title','body'];

    // public $timestamps = false;

    public function ScopeSelection($query){
        return $query->select('id', 'title', 'body', 'created_at', 'updated_at');
    }
}
