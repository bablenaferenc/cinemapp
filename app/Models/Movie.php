<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ScreeningEvent;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'age_restriction',
        'language',
        'cover_image',
    ];

    public static $rules = [
        'title' => 'required|string',
        'description' => 'nullable|string',
        'age_restriction' => 'nullable|integer',
        'language' => 'nullable|string',
        'cover_image' => 'nullable|image',
    ];

    // attributeNames
    public static $attibuteNames = [
        'title' => 'Cím',
        'description' => 'Leírás',
        'age_restriction' => 'Korhatár',
        'language' => 'Nyelv',
        'cover_image' => 'Borítókép',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * The screening events that belong to the movie.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany;
     */
    public function screeningEvents(): HasMany
    {
        return $this->hasMany(ScreeningEvent::class);
    }
}
