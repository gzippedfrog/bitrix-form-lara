<?php

namespace App\Models;

use App\Events\LeadCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'second_name',
        'last_name',
        'email',
        'phone',
        'birthdate',
        'message',
        'bitrix_id'
    ];

    /**
     * The events that class dispatches.
     * @var string[]
     */
    protected $dispatchesEvents = [
        'created' => LeadCreated::class,
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $casts = [
        'birthdate' => 'date'
    ];
}
