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
        $fields = \DB::table('eds_fields')->select('field', 'validations')->where('table', $topRes)->get();
        $this->rules = [];
        foreach($fields as $field) {
            $this->rules[$field->field] = json_decode($field->validations);
        }
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