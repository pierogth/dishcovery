<?php

namespace App\Http\Requests\Api;

class DeleteArticle extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $article = $this->route('article');

        /*bypass control, the frontend check if the user is admin show the button for delete*/
        return true;
    }
}
