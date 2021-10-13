<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TaxonomyCourseType extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public $table = 'taxonomy_course_types';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'field_offsiteid',
        'field_adsubscribable',
        'field_custom_course_layout',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function fieldCourseTypeTaxonomyCourses()
    {
        return $this->hasMany(TaxonomyCourse::class, 'field_course_type_id', 'id');
    }

    public function fieldCourseTypeCourseTopics()
    {
        return $this->hasMany(CourseTopic::class, 'field_course_type_id', 'id');
    }

    public function fieldCourseTypeCourseProducts()
    {
        return $this->hasMany(CourseProduct::class, 'field_course_type_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
