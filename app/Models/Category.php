<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'icon',
        'order',
    ];

    /**
     * Get the tools for the category.
     */
    public function tools(): HasMany
    {
        return $this->hasMany(Tool::class);
    }

    /**
     * Get the translations for the category.
     */
    public function translations(): HasMany
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    /**
     * Get the translation for the current locale.
     */
    public function translation(?string $locale = null): ?CategoryTranslation
    {
        $locale = $locale ?? app()->getLocale();
        
        return $this->translations()
            ->where('locale', $locale)
            ->first();
    }

    /**
     * Scope to order categories by their order field.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
