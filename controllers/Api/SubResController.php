<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Base\Controller\BaseController;

class SubResController extends BaseController {

    public function __construct(
    \App\Repositories\QueryBuilderRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function resIndex(Request $request, $topRes, $topId, $subRes) {

        $this->repository->setTable($subRes);
        $this->repository->where([str_singular($topRes) . "_id", "=", $topId]);

        return parent::index($request);
    }

    // #### not needed only need index, create and delete
    public function resShow(Request $request, $topRes, $topId, $subRes, $subId) {

        $this->repository->setTable($topRes);

        return parent::show($id);
    }

    public function resDestroy($type, $id) {

        return parent::destroy($id);
    }

    public function resUpdate($type, $id, Request $request) {

        return parent::update($request, $id);
    }

}
