<?php

namespace App\Domains\Medias\Presenters;

use App\Domains\Medias\Transformers\MediaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class MediaFractalPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MediaTransformer();
    }
}