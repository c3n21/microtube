<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    const CREATED_AT = null;
    const UPDATED_AT = 'uploaded_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
