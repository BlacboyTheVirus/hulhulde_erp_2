<?php

namespace App\Models\Production;

use App\Models\Input;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Production extends Model
{
    use HasFactory;

    protected $fillable = [
        'count_id',
        'code',
        'input_id',
        'production_date',
        'requested_weight',
        'note',
        'status',
        'next',
        'user_id',
    ];

    public function input():BelongsTo{
        return $this->belongsTo(Input::class);
    }

    public function warehouse():HasOne{
        return $this->hasOne(Warehouse::class);
    }

    public function outputs(): HasMany{
        return $this->hasMany(Output::class);
    }

    public function stores(): HasMany{
        return $this->hasMany(Store::class);
    }


    protected function productionDate(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->format('d-m-Y'),
            set: fn (string $value) => Carbon::parse($value)->format('Y-m-d'),
        );
    }

}
