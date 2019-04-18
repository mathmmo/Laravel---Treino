<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\aprovedRepository;
use App\Entities\Aproved;
use App\Validators\AprovedValidator;

/**
 * Class AprovedRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AprovedRepositoryEloquent extends BaseRepository implements AprovedRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Aproved::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AprovedValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
