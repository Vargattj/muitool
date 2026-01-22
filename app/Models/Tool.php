<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tool extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'slug',
        'icon',
        'view_component',
        'is_active',
        'meta_data',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'meta_data' => 'array',
    ];

    /**
     * Get the category that owns the tool.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the translations for the tool.
     */
    public function translations(): HasMany
    {
        return $this->hasMany(ToolTranslation::class);
    }

    /**
     * Get the translation for the current locale.
     */
    public function translation(?string $locale = null): ?ToolTranslation
    {
        $locale = $locale ?? app()->getLocale();
        
        return $this->translations()
            ->where('locale', $locale)
            ->first();
    }

    /**
     * Scope to only include active tools.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to find by slug.
     */
    public function scopeBySlug($query, string $slug)
    {
        return $query->where('slug', $slug);
    }
}
