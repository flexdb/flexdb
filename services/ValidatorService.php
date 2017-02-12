<?php
namespace Modules\Flexwb\Services;

use Modules\Flexwb\Controllers\Eds\EdsTablesController;
use Illuminate\Http\Request;
use Validator;

class ValidatorService {

    protected $table;
    protected $rules;
    protected $errors;
    protected $validator;


    public function __construct() {



    }

    public function getRules($topRes) {
        $this->rules = ['name' => 'required'];
        return $this;
    }

    public function validate($data) {
        
        $this->validator = Validator::make($data, $this->rules);
        

        if(!$this->validator->fails()) {
            return true;
        } else {
            $this->errors = $this->validator->errors();
            return false;
        }
        
    }

    public function getErrors() {

        return $this->validator->errors();

    }




    
}