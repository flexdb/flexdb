<?php

namespace Modules\Flexwb\Controllers\Api;


use Illuminate\Http\Request;
use Modules\Base\Controller\BaseController;
use Modules\Flexwb\Services\ValidatorService;
use Modules\Qbrepository\QueryBuilderRepository;

class ResController extends BaseController {

    protected $notifications = [];

    public function __construct(QueryBuilderRepository $repository) {
        $this->repository = $repository;
        $this->validator = new ValidatorService();
    }

    public function resIndex(Request $request, $topRes) {
        $with = $request->get('with');
        $res = $this->repository;
        if(!empty($with)) {
            $with = explode(',', $with);
            $res = $res->with($with);
        }
      
        return $res->index($request, $topRes);
    }

    public function resShow($topRes, $topId) {

        $dataAndRelations = $this->repository->get($topRes, $topId);
        if(!empty($dataAndRelations)) {
            $data = $dataAndRelations['data'];
            $relations = $dataAndRelations['relations'];
            return response()->json($data)->header('x-relations', json_encode($relations));
        } else {
            
            $errorMsg = 'Resource '.$topRes.' with id '.$topId.' NOT found';
            array_push($this->notifications, ['type' => 'error', 'msg' => $errorMsg ]);
            return response()
                    ->json(['error' => $errorMsg])
                    ->setStatusCode(404, $errorMsg)
                    ->header('x-relations', json_encode([]))
                    ->header('x-notifications', json_encode($this->notifications));
        }
        
    }

    public function resStore(Request $request, $topRes) {

        $data = $request->all();
        $isValid = $this->validator->getRules($topRes)->validate($data);
        if($isValid) {

            $newItem = $this->repository->store($data, $topRes);
            return response()->json($newItem);
            
        } else {
            
            return $this->validator->errorResponse();
        }

        
        
    }

    public function resDestroy($topRes, $topId) {

        return $this->repository->remove($topRes, $topId);
    }

    public function resUpdate($type, $id, Request $request) {

        return $this->repository->update($type, $id, $request);
    }

    public function resRelations($resName) {

        return $fks = \DB::table('eds_fields')->where('table', '=', $resName)->where('key_type', '=', 'fk')->get();
    }

}
