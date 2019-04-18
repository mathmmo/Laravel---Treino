<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AprovedCreateRequest;
use App\Http\Requests\AprovedUpdateRequest;
use App\Repositories\AprovedRepository;
use App\Validators\AprovedValidator;
use Gate;

/**
 * Class AprovedsController.
 *
 * @package namespace App\Http\Controllers;
 */
class AprovedsController extends Controller
{
    /**
     * @var AprovedRepository
     */
    protected $repository;

    /**
     * @var AprovedValidator
     */
    protected $validator;

    /**
     * AprovedsController constructor.
     *
     * @param AprovedRepository $repository
     * @param AprovedValidator $validator
     */
    public function __construct(AprovedRepository $repository, AprovedValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('isAdmin')){
            abort(404,"Desculpe, você não tem acesso a essa área.");
        };
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $aproveds = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $aproveds,
            ]);
        }

        return view('aproved.index', compact('aproveds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AprovedCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(AprovedCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $aproved = $this->repository->create($request->all());

            $response = [
                'message' => 'Aproved created.',
                'data'    => $aproved->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aproved = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $aproved,
            ]);
        }

        return view('aproveds.show', compact('aproved'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aproved = $this->repository->find($id);

        return view('aproveds.edit', compact('aproved'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AprovedUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(AprovedUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $aproved = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Aproved updated.',
                'data'    => $aproved->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Aproved deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Aproved deleted.');
    }
}
