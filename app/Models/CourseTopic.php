<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CourseTopic extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public $table = 'course_topics';

    protected $dates = [
        'field_aana_expiration_date',
        'field_expiration_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'body',
        'field_offsiteid',
        'field_speakers',
        'field_ad_code',
        'field_supplier_code',
        'field_on_sale',
        'field_position',
        'field_volume',
        'field_issue',
        'field_course_type_id',
        'field_course_credit_type_id',
        'field_practice_type_id',
        'field_armscode_id',
        'field_web_category_id',
        'field_ad_service_id',
        'field_media_provider_id',
        'field_media_provider_topic',
        'field_aana_expiration_date',
        'field_expiration_date',
        'field_price',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function fieldTopicsNodesCourseProducts()
    {
        return $this->belongsToMany(CourseProduct::class);
    }

    public function field_course_type()
    {
        return $this->belongsTo(TaxonomyCourseType::class, 'field_course_type_id');
    }

    public function field_course_credit_type()
    {
        return $this->belongsTo(TaxonomyCreditType::class, 'field_course_credit_type_id');
    }

    public function field_practice_type()
    {
        return $this->belongsTo(TaxonomyPracticeType::class, 'field_practice_type_id');
    }

    public function field_armscode()
    {
        return $this->belongsTo(TaxonomyArmsCode::class, 'field_armscode_id');
    }

    public function field_web_category()
    {
        return $this->belongsTo(TaxonomyWebCategory::class, 'field_web_category_id');
    }

    public function field_ad_service()
    {
        return $this->belongsTo(TaxonomyAdService::class, 'field_ad_service_id');
    }

    public function field_media_provider()
    {
        return $this->belongsTo(TaxonomyMediaProvider::class, 'field_media_provider_id');
    }

    public function getFieldAanaExpirationDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFieldAanaExpirationDateAttribute($value)
    {
        $this->attributes['field_aana_expiration_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getFieldExpirationDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFieldExpirationDateAttribute($value)
    {
        $this->attributes['field_expiration_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
