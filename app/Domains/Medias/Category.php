<?php

namespace App\Domains\Medias;

use App\Domains\Medias\Rules\CategoryRules;
use App\Support\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use LogsActivity;
    use SoftDeletes;

    protected $rulesFrom             = CategoryRules::class;

    protected $columnTitle           = 'title';
    protected $entityDomainAlias     = 'medias';
    protected $entityTranslationKey  = 'category';
    protected $entityGender          = 'F';
    protected $entityIcon            = 'fa fa-fw fa-image';
    protected $entityRouteAlias      = 'medias_categories';
    protected $entityViewsAlias      = 'medias-categories';
    protected $entityRoutePrefix     = 'media-categories';
    protected $table                 = 'media_categories';
    protected $mediaCategorySlug     = 'media_categories';

    protected $entityAllowedMedias   = [
        'images',
        'documents',
    ];

    protected $fillable = [
        'title',
        'slug',
        'intro',
        'body',
        'seo',
        'active',
    ];

    public function categoryMedias()
    {
        return $this->hasMany(Media::class, 'category_id', 'id');
    }

}