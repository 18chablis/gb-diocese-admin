<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parish extends Model
{
    use HasFactory;

    protected $fillable = [
        'parish_name',
        'parish_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function shepherds()
    {
        return $this->belongsToMany(Shepherd::class);
    }
}
