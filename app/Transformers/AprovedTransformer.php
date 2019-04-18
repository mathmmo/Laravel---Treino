<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Aproved;

/**
 * Class AprovedTransformer.
 *
 * @package namespace App\Transformers;
 */
class AprovedTransformer extends TransformerAbstract
{
    /**
     * Transform the Aproved entity.
     *
     * @param \App\Entities\Aproved $model
     *
     * @return array
     */
    public function transform(Aproved $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
