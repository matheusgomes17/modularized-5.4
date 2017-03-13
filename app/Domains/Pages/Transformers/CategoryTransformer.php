<?php

namespace App\Domains\Pages\Transformers;

use App\Domains\Pages\Category;
use League\Fractal\TransformerAbstract;

/**
 * Class CategoryTransformer
 * @package  App\Domains\Pages
 */
class CategoryTransformer extends TransformerAbstract
{
    protected $availableIncludes = [

    ];

    protected $defaultIncludes = [

    ];

    /**
     * Transform the App\Domains\Pages\Category entity
     * @param  Category $model
     *
     * @return  array
     */
    public function transform(Category $model)
    {
        return [
            'id'         => $model->id,
            'title'      => $model->title,
            'slug'       => $model->slug,
            'intro'      => $model->intro,
            'body'       => $model->body,
            'active'     => $model->active,
            'deleted_at' => $model->deleted_at,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }
}