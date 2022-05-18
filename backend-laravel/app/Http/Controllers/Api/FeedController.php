<?php

namespace App\Http\Controllers\Api;

use App\RealWorld\Paginate\Paginate;
use App\RealWorld\Transformers\ArticleTransformer;
use App\Article;

class FeedController extends ApiController
{
    /**
     * FeedController constructor.
     *
     * @param ArticleTransformer $transformer
     */
    public function __construct(ArticleTransformer $transformer)
    {
        $this->transformer = $transformer;

        $this->middleware('auth.api');
    }

    /**
     * Get all the articles of users that are followed by the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $user = auth()->user();

        $articles = new Paginate($user->feed());

        return $this->respondWithPagination($articles);
    }

    /**
     * Get top rated articles 
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function topRated()
    {
       

        $articles = Article::loadRelations()->get()->toArray();

        foreach($articles as $article)
        usort($articles, function($a, $b) {if($a['favorited_count'] > $b['favorited_count']) {return 0;} else {return 1;}});


        $output = array_slice($articles,0,3);

        $real_output = new \StdClass;
        $real_output->articles = $output;

       
        return json_decode(json_encode($real_output),true);

    }
}
