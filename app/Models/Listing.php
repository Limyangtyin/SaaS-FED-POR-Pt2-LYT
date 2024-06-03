<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'salary',
        'city',
        'state',
        'tags',
        'company',
        'address',
        'phone',
        'email',
        'requirement',
        'benefits'
    ];

    protected $casts = [
        'tags' => 'array'
    ];
}
