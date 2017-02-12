<?php
namespace Modules\Flexwb\Services;

use Modules\Flexwb\Controllers\Eds\EdsTablesController;
use Illuminate\Http\Request;

class ValidatorService {

    protected $table;


    public function __construct() {



    }

    public function getRules($topRes) {
        return this;
    }

    public function validate($data) {
        return true;
    }


    
}