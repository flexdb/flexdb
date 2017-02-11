<?php

namespace Modules\Flexwb\Controllers\Eds;

use Illuminate\Http\Request;
use Modules\Flexwb\Controllers\Eds\TableService;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class ReportController
{

    protected $fieldDefs;

    protected $notifications = [];

    public function __construct(\App\Repositories\QueryBuilderRepository $repo, Request $request) {
        $this->repo = $repo;
        $this->request = $request;

    }
    function basicTable($reportName) {
        
        $reportTables = explode(",",$reportName);
        $joinTables = array_slice($reportTables, 1);

        $this->getFieldDefs($reportTables);

//        $this->fieldDefs;
        $joinTableDefs = $this->getJoinTableDefs($joinTables);
        $selects = $this->getSelectValues();
        array_push($selects, 'project_islands.island_id as this_project_island');
        array_push($selects, 'islands.name as project_island_name');
        
        $tableService = new TableService($this->repo, $this->request);
//        return $tableService->getDbFields();
        $q = $fieldDef = \DB::table($reportTables[0])->select($selects);
        
        foreach($joinTables as $table) {
            $linkTableDef = $this->fieldDefs->where('link_table', $table)->first();
            $q->leftJoin($table, $linkTableDef->table.'.'.$linkTableDef->field, '=', $table.'.'.$linkTableDef->link_field);
        }

        $q->leftJoin('project_islands', 'project_islands.project_id', '=', 'projects.id');
        $q->leftJoin('islands', 'project_islands.island_id', '=', 'islands.id');
        $data = $q->get();
        $excludeCols = [];
        $total = 0;
        return view('report_table', compact('data', 'excludeCols', 'total'));
                
        
        
        
    }

    function getJoinTableDefs($joinTables) {
        return $this->fieldDefs->whereIn('link_table', $joinTables);
    }


    function getFieldDefs($reportTables) {

        $this->fieldDefs = \DB::table('eds_fields')->whereIn('table', $reportTables)->orderBy('table')->get();
        return $this;
    }

    function getSelectValues() {
        $selects = [];
        foreach($this->fieldDefs as $field) {
            if(substr($field->field, -3) != '_id') {
                $selects[] = $field->table.'.'.$field->field.' as '.$field->table.'_'.$field->field;
            }
        }

        return $selects;
    }
}
