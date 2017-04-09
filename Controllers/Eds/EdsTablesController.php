<?php

namespace Modules\Flexwb\Controllers\Eds;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ResController;
use Modules\Qbrepository\QueryBuilderRepository;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class EdsTablesController
{

    protected $notifications = [];

    public function __construct(QueryBuilderRepository $repo, Request $request) {
        $this->repo = $repo;
        $this->request = $request;

    }
    function tables() {

        $dbUserTables = $this->getDbUserTables();

        $edsUserTables = $this->getEdsUserTables();

        return [
            'dbLastCreated' => [
                'group_label' => "Last Created",
                'tables' => $dbUserTables->take(1)->all()
                ],
            'edsUserTables' => [
                'group_label' => "Defined Tables",
                'tables' => $edsUserTables->all()
                ],
            'dbUserTables' => [
                'group_label' => "All Tables",
                'tables' => $dbUserTables->all()
                ],
        ];
    }

    function getColumns($table) {
        return Schema::getColumnListing($table);
    }

    function getDbUserTables() {

        $systemTables = array_values(config('eds.tables.system_tables'));
        $dbTableList = collect(\DB::select('SELECT TABLE_NAME FROM information_schema.tables WHERE table_schema = DATABASE() ORDER BY CREATE_TIME DESC'));

        $dbUserTables = $dbTableList->filter( function ($item) use ($systemTables) {
            if(!in_array($item->TABLE_NAME, $systemTables)) {
                return $item;
            }
        })->pluck('TABLE_NAME');

        return $dbUserTables;

    }

    function getDbFields() {
        $fields = [];
        $tables = $this->getDbUserTables();
        foreach($tables as $table) {
            $columns = $this->getColumns($table);
            $columns = array_diff($columns, ['id', 'created_at', 'updated_at']);
            if(count($columns) > 0) {
                $fields[$table] = array_values($columns);
            }
            
        }
        return $fields;

    }
    
    function getEdsUserTables() {
        return \DB::table('eds_fields')->select('table')->distinct()->pluck('table');
    }

    function index($table) {
        return view('table.index');
    }

    function create() {
        return view('table.create');
    }

    function store(Request $request) {
        $newTableName = $request->get('table');

        if(Schema::hasTable($newTableName)) {
            return response()->json(["msg" => "Table Already Exists"], 400);
        } else {
            return $this->createTable($newTableName);
        }

    }

    function createTable($newTableName) {

        $newTableName = str_plural($newTableName);

        $created = Schema::create($newTableName, function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        if(Schema::hasTable($newTableName)) {
            return response()->json(["msg" => "Table $newTableName Created"], 200);
        }

    }

    function fieldList($table) {
        return \DB::table('eds_fields')->where('table', $table)->get();
    }

    function remove($tableName) {
        Schema::dropIfExists($tableName);

        if(!Schema::hasTable($tableName)) {
            return response()->json(["msg" => "Table $tableName Deleted"], 200);
        }

    }
    
    function createField(Request $request, $tableName) {
//        dd($tableName);
        $fieldDef = [];
        $newField = $request->all();

        if(!empty($newField['key_type'])) {
            $field = !empty($newField['field'])?str_singular($newField['field']): null;
            $link_table = !empty($newField['link_table'])?str_singular($newField['link_table']):null;

            if($newField['key_type'] == 'fk' && empty($newField['field'])) {
                $newField['field'] = $link_table."_id";
                array_push($this->notifications, ['type' => 'success', 'msg' => 'Field name set to '.$newField['field'] ]);
            } elseif ( $field == $link_table )
            {
                $newField['field'] = $link_table."_id";
                array_push($this->notifications, ['type' => 'info', 'msg' => 'Field name changed to '.$newField['field'] ]);
            }
        }
        
        $type = $newField['type'];

        if(!Schema::hasColumn($tableName, $newField['field'])) {
            Schema::table($tableName, function (Blueprint $table) use ($type, $newField) {
                $table->{$type}($newField['field']);
            });

            array_push($this->notifications, ['type' => 'success', 'msg' => 'Created field '.$newField['field'] ]);
         } else {
            array_push($this->notifications, ['type' => 'warning', 'msg' => 'Field '.$newField['field'].' exists. Skipping field creation!' ]);
         }



        if(\DB::table('eds_fields')->where('table', '=', $tableName)->where('field', '=', $newField['field'])->get()->isEmpty()) {

            $fieldDef = (new \App\Repositories\QueryBuilderRepository($request))->store($newField, 'eds_fields');
            array_push($this->notifications, ['type' => 'success', 'msg' => 'Created field definition for  '.$newField['field'] ]);

            if(!empty($newField['key_type']) && $newField['key_type'] == 'fk' ) {
                $newLink = ['table2' => $newField['table'], 'table1' => $newField['link_table'], 'relation_type' => 'hasMany'];
                $this->storeLink($newLink);
            }

        } else {
            array_push($this->notifications, ['type' => 'warning', 'msg' => 'Field definition exisits for  '.$newField['field'].' Skipping field def creation!' ]);
        }

        return response()->json(json_encode($fieldDef))->header('x-notifications', json_encode($this->notifications));
        
    }


    
    function deleteField($tableName, $fieldName) {

        Schema::table($tableName, function (Blueprint $table) use ($tableName, $fieldName) {
             $table->dropColumn($fieldName);
        });
        
        $deleteStatus = \DB::table('eds_fields')->where('table', '=', $tableName)->where('field', '=', $fieldName)->delete();
        
        return json_encode($deleteStatus);
    }


    function addLink(Request $request, $tableName) {
//        dd($tableName);

        $newLink = $request->all();
        $this->storeLink($newLink);
        return response()->json(json_encode($fieldDef))->header('x-notifications', json_encode($this->notifications));

    }

    function storeLink($newLink) {
        

        $request = app('Illuminate\Http\Request');

        if(\DB::table('eds_relations')->where('table1', '=', $newLink['table1'])->where('table2', '=', $newLink['table2'])->get()->isEmpty()) {

            $fieldDef = (new \App\Repositories\QueryBuilderRepository($request))->store($newLink, 'eds_relations');
            array_push($this->notifications, ['type' => 'success', 'msg' => 'Created Link  to '.$newLink['table2'] ]);

        } else {
            array_push($this->notifications, ['type' => 'warning', 'msg' => 'Link to table  '.$newLink['table2'].' already existing . Skipped Link creation!' ]);

        }

        return true;
    }


}
