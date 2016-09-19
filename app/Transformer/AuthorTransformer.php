<?php namespace App\Transformer;

use App\AccountMongo;
use League\Fractal\TransformerAbstract;

class AuthorTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'author'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(AccountMongo $author)
    {
        return [
            'id'    => (int) $author->id,
            'name' => $author->name,
            'feed_url'    => $author->feed_url,
            'logo'    => $author->logo,
            'last_update' => (string) $author->latestNews->created_at
        ];
    }
}