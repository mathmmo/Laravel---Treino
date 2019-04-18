<?php

namespace App\Presenters;

use App\Transformers\AprovedTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AprovedPresenter.
 *
 * @package namespace App\Presenters;
 */
class AprovedPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AprovedTransformer();
    }
}
