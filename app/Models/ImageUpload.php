<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageUpload extends Model
{
    use HasFactory;

    protected $table = 'galleries';

    protected $fillable = [
        'fileTitle', 
        'fileName'
    ]; 
}
