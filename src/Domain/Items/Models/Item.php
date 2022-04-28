<?php

namespace Domain\Items\Models;

use Database\Factories\ItemFactory;
use Domain\Requisitions\Models\Requisition;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Src\App\Traits\TraitUuid;

class Item extends Model
{
    use HasFactory, TraitUuid;

    protected static string $uuidFieldName = 'reference';
    /**
     * @var string[]
     */
    protected $fillable = [
        'reference',
        'name',
        'requisition_id'
    ];

    protected $hidden = [
        'id',
        'requisition_id',
        'requisition_uuid'
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory(): Factory
    {
        return ItemFactory::new();
    }

    public function requisition(): BelongsTo
    {
        return $this->belongsTo(Requisition::class, 'requisition_id', 'id');
    }
}
