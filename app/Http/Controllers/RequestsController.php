<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\RequestCreateRequest;
use App\Http\Requests\RequestUpdateRequest;
use App\Repositories\RequestRepository;
use App\Validators\RequestValidator;
use Gate;

/**
 * Class RequestsController.
 *
 * @package namespace App\Http\Controllers;
 */
class RequestsController extends Controller
{
    /**
     * @var RequestRepository
     */
    protected $repository;

    /**
     * @var RequestValidator
     */
    protected $validator;

    /**
     * RequestsController constructor.
     *
     * @param RequestRepository $repository
     * @param RequestValidator $validator
     */
    public function __construct(RequestRepository $repository, RequestValidator $validator)
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
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $requests = $this->repository->all();

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $requests,
            ]);
        }

        return view('request.index', compact('requests'));
    }

    public function pending()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $requests = $this->repository->all();

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $requests,
            ]);
        }

        return view('pending.index', compact('requests'));
    }

    public function aproved()
    {
        if(!Gate::allows('isUser')){
            abort(404,"Desculpe, você não tem acesso a essa área.");
        };
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $requests = $this->repository->all();

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $requests,
            ]);
        }
        return view('aproved.index', compact('requests'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RequestCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(RequestCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $request = $this->repository->create($request->all());

            $response = [
                'message' => 'Request created.',
                'data'    => $request->toArray(),
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
        $request = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $request,
            ]);
        }

        return view('requests.show', compact('request'));
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
        $request = $this->repository->find($id);

        return view('requests.edit', compact('request'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RequestUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(RequestUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $request = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Request updated.',
                'data'    => $request->toArray(),
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
                'message' => 'Request deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Request deleted.');
    }
}
