<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\City
 * 
 * @property int $id
 * @property int $province_id
 * @property string $name
 * @property string $type
 * @property string $postal_code
 * @property DateTimeInterface|null $created_at
 * @property DateTimeInterface|null $updated_at
 */
class City extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['province_id', 'name', 'type', 'postal_code'];

    /**
     * Retrieve Province data that belongs to Province
     * @return BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }
}
