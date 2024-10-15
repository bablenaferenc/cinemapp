<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Movie;

class ScreeningEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'time',
        'available_seats',
        'movie_id',
    ];

    public static $rules = [
        'time' => 'required|date',
        'available_seats' => 'required|integer',
        'movie_id' => 'required|integer|exists:movies,id',
    ];

    public static $attibuteNames = [
        'time' => 'Időpont',
        'available_seats' => 'Elérhető helyek száma',
        'movie_id' => 'Film',
    ];

    // cast
    protected $casts = [
        'time' => 'datetime:Y-m-d H:i',
        'available_seats' => 'integer',
        'movie_id' => 'integer',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * The movie that belongs to the screening event.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo;
     */
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
}
