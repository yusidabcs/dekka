<?php namespace App\Transformer;

use App\NewsMongo;
use League\Fractal\TransformerAbstract;

class NewsTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'author'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(NewsMongo $news)
    {
        
        return [
            '_id'    =>  $news->id,
            'title' => ucwords($news->title),
            'url'    => url('http://dekkanews.com/news/'.$news->id),
            'content'    => (string) $this->cleanHtml($news->content),
            'image'    => str_replace("-300x200", "",$news->image),
            'thumb'    => $news->image,
            'short_content'    => (string) $this->short($news->content),
            //'categories'   => $news->categories,
            'created_at'    => (string) $news->created_at,
            'categories' => $news->categories,
            'view'    => (int) $news->view,
        ];
    }

    /**
     * Include Author
     *
     * @return League\Fractal\ItemResource
     */
    public function includeAuthor(NewsMongo $news)
    {
        $author = $news->author;

        return $this->item($author, new AuthorTransformer);
    }

    public function includeCategories(NewsMongo $news)
    {
        
        $categories = $news->categories();

        return $this->collection($categories, new CategoryTransformer);
    }

    public function cleanHtml($html){

        //remove new line
        $html = trim(preg_replace('/\s+/', ' ', $html));
        //remove image link
        $html = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $html);

        $html = preg_replace('%(.*?)<p>\s*(<img[^<]+?)\s*</p>(.*)%is', '$1$2$3', $html);

        //remove width and height
        $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
        //remove
        return $html;
    }

    public function short($html){
        

        $html = trim(preg_replace('/\s+/', ' ', $html));
        //remove image link
        $html = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $html);

        $html = preg_replace('%(.*?)<p>\s*(<img[^<]+?)\s*</p>(.*)%is', '$1$2$3', $html);

        //remove width and height
        $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );

        $chr_map = array(
           // Windows codepage 1252
           "\xC2\x82" => "'", // U+0082⇒U+201A single low-9 quotation mark
           "\xC2\x84" => '"', // U+0084⇒U+201E double low-9 quotation mark
           "\xC2\x8B" => "'", // U+008B⇒U+2039 single left-pointing angle quotation mark
           "\xC2\x91" => "'", // U+0091⇒U+2018 left single quotation mark
           "\xC2\x92" => "'", // U+0092⇒U+2019 right single quotation mark
           "\xC2\x93" => '"', // U+0093⇒U+201C left double quotation mark
           "\xC2\x94" => '"', // U+0094⇒U+201D right double quotation mark
           "\xC2\x9B" => "'", // U+009B⇒U+203A single right-pointing angle quotation mark

           // Regular Unicode     // U+0022 quotation mark (")
                                  // U+0027 apostrophe     (')
           "\xC2\xAB"     => '"', // U+00AB left-pointing double angle quotation mark
           "\xC2\xBB"     => '"', // U+00BB right-pointing double angle quotation mark
           "\xE2\x80\x98" => "'", // U+2018 left single quotation mark
           "\xE2\x80\x99" => "'", // U+2019 right single quotation mark
           "\xE2\x80\x9A" => "'", // U+201A single low-9 quotation mark
           "\xE2\x80\x9B" => "'", // U+201B single high-reversed-9 quotation mark
           "\xE2\x80\x9C" => '"', // U+201C left double quotation mark
           "\xE2\x80\x9D" => '"', // U+201D right double quotation mark
           "\xE2\x80\x9E" => '"', // U+201E double low-9 quotation mark
           "\xE2\x80\x9F" => '"', // U+201F double high-reversed-9 quotation mark
           "\xE2\x80\xB9" => "'", // U+2039 single left-pointing angle quotation mark
           "\xE2\x80\xBA" => "'", // U+203A single right-pointing angle quotation mark
        );
        $chr = array_keys  ($chr_map); // but: for efficiency you should
        $rpl = array_values($chr_map); // pre-calculate these two arrays
        $html = str_replace($chr, $rpl, html_entity_decode($html, ENT_QUOTES, "UTF-8"));

        $html = strip_tags($html);

        return substr($html, 0, strlen($html) > 200 ? 200 : strlen($html));
    }
}