<?php namespace App\Transformer;

use App\CategoryMongo;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        
    ];

    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(CategoryMongo $category)
    {
        return [
            'id' => $category->id,
            'name' => ucwords($category->name),
            'logo' => $category->logo,
            'status' => (int) $category->status,
        ];
    }
}