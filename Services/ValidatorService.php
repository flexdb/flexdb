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
        $defaults = 
        $fields = \DB::table('eds_fields')->select('field', 'validations', 'type')->where('table', $topRes)->get();
        $this->rules = [];
        foreach($fields as $field) {
            if(!empty($fields->validations)) {
                $this->rules[$field->field] = json_decode($field->validations);
            } else {

                if($field->type == 'date') {
                    $this->rules[$field->field] = ['required', 'date'];
                } elseif($field->type == 'integer') {
                    $this->rules[$field->field] = ['required', 'numeric'];
                } else {
                    $this->rules[$field->field] = ['required'];
                }
            }
            
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

    public function errorResponse() {
            $errors = $this->validator->errors();
            $notifications = [];
            array_push($notifications, ['type' => 'error', 'msg' => 'Possibly incorrect data. Please fix them.' ]);
            return response()
                    ->json(['errors' => $errors])
                    ->setStatusCode(400, "Bad Request - Validataion Errors")
                    ->header('x-relations', json_encode([]))
                    ->header('x-notifications', json_encode($notifications));
    }





}