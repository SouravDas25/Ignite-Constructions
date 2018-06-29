<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Table 
    protected $table = 'posts';
    //Primary Key
    public $primarykey = 'id';
    //timestamps
    public $timestamps ='true';


}
    