<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCoupon extends Model
{
    use HasFactory;

    public const TYPE_SELECT = [
        'percent' => 'Percent (%)',
        'fixed'   => 'Fixed (USD)',
    ];

    public $table = 'course_coupons';

    protected $dates = [
        'date_from',
        'date_to',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'code',
        'uses',
        'field_offsiteid',
        'type',
        'amount',
        'active',
        'on_demand',
        'invert',
        'exclusive',
        'date_from',
        'date_to',
        'media_type_id',
        'prev_days_less',
        'prev_days_more',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getDateFromAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDateFromAttribute($value)
    {
        $this->attributes['date_from'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getDateToAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDateToAttribute($value)
    {
        $this->attributes['date_to'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function media_type()
    {
        return $this->belongsTo(TaxonomyMediaType::class, 'media_type_id');
    }

    public function products()
    {
        return $this->belongsToMany(CourseProduct::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
