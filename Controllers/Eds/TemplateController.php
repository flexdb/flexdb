<?php

namespace Modules\Flexwb\Controllers\Eds;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Flexwb\Services\TableService;

class TemplateController extends Controller
{
    function index($resName) {
        $tableName = $resName;
        $fields = \DB::table('eds_fields')->where('table','=', $tableName)->get();
        return view('fwb::list', compact('resName', 'fields'));
    }

    function get($resName, $itemId) {
        $tableName = $resName;
        $tableService = new TableService();
        
        $allFields = $tableService->getFieldDefs();
        $subRes = $tableService->table($resName)->getHasMany()->pluck('field', 'table');
        $fields = $allFields->where('table','=', $tableName);
        $relations = [];
        foreach($subRes as $rel => $linkField) {
            
            $relations[$rel]['fields'] = $allFields->where('table','=', $rel)->toArray();
            $relations[$rel]['linkField'] = $linkField;
        
            // TODO: add link field to be used in template for add dialog
        }
        
        
        return view('fwb::item', compact('fields', 'tableName', 'id', 'subRes', 'relations'));
    }
}
