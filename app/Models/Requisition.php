<?php

namespace App\Models;

use App\Traits\TraitUuid;
use Database\Factories\RequisitionFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Requisition extends Model
{
    use TraitUuid, HasFactory;
    /**
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'name',
        'description'
    ];

    protected $hidden = [
        'id'
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory(): Factory
    {
        return RequisitionFactory::new();
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class, 'requisition_id', 'id');
    }
}
