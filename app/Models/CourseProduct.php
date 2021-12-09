<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CourseProduct extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public const FIELD_COURSE_LENGTH_SELECT = [
        'full'       => 'Full Course',
        'short'      => 'Short Course',
        'short_a'    => 'Short Course/Part A',
        'short_b'    => 'Short Course/Part B',
        'any'        => 'Short Course (Any Topics)',
        'short_odd'  => 'Short Course/Odd',
        'short_even' => 'Short Course/Even',
        'topic'      => 'Topic',
    ];

    public $table = 'course_products';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'sku',
        'commerce_price',
        'status',
        'field_description',
        'field_course_length',
        'field_offsiteid',
        'field_supplier_code',
        'field_is_ondemand',
        'field_disk_availability',
        'field_dental_report_text',
        'field_download_availability',
        'field_standard_credit_hours',
        'field_course_type_id',
        'field_course_credit_type_id',
        'field_practice_type_id',
        'field_media_provider_id',
        'field_media_delivery_type_id',
        'field_web_category_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function fieldCourseProductsCourseInstructors()
    {
        return $this->belongsToMany(CourseInstructor::class);
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

    public function field_media_provider()
    {
        return $this->belongsTo(TaxonomyMediaProvider::class, 'field_media_provider_id');
    }

    public function field_media_delivery_type()
    {
        return $this->belongsTo(TaxonomyMediaDelivery::class, 'field_media_delivery_type_id');
    }

    public function field_web_category()
    {
        return $this->belongsTo(TaxonomyWebCategory::class, 'field_web_category_id');
    }

    public function field_topics_nodes()
    {
        return $this->belongsToMany(CourseTopic::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
