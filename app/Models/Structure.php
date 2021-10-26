<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Structure extends Model
{
    use SoftDeletes;
    use HasFactory;
    use NodeTrait;

    public const TYPE_SELECT = [
        'page' => 'Page',
        'link' => 'Link',
    ];

    public $table = 'structures';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'label',
        'type',
        'link',
        'external',
        'page_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function page()
    {
        return $this->belongsTo(ContentPage::class, 'page_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
