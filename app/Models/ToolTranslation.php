<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ToolTranslation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tool_id',
        'locale',
        'name',
        'short_description',
        'description',
        'meta_title',
        'meta_description',
        'faq',
        'use_cases',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'faq' => 'array',
        'use_cases' => 'array',
    ];

    /**
     * Get the tool that owns the translation.
     */
    public function tool(): BelongsTo
    {
        return $this->belongsTo(Tool::class);
    }
}
