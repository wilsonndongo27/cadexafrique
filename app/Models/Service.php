<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Articles;

class Service extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'service';

    protected $attributes = [ 'id', 'user_id', 'title', 'description' ];

    protected $fillable = ['id', 'user_id', 'title', 'description'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function articles()
    {
        return $this->belongsToMany(Articles::class);
    }
}
