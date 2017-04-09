<?php
namespace Modules\Flexwb\Services;

use Modules\Flexwb\Controllers\Eds\EdsTablesController;
use Illuminate\Http\Request;
use Modules\Qbrepository\QueryBuilderRepository;

class TableService {

    protected $table;

    protected $fieldDefs;

    public function __construct() {

        $this->tempHack = new EdsTablesController((new QueryBuilderRepository((new Request()))), (new Request()));
    }

    function table($table) {
        $this->table = $table;
        return $this;
    }
    
    function isSetTable() {
        if(empty($this->table)) {
            throw new \Exception('Table in TableService is not set');
        }
    }
    
    function getHasMany() {
        $this->isSetTable();
        $fieldDefs = $this->getFieldDefs();
        return $fieldDefs->where('link_table', $this->table);

    }

    function getFieldDefs($refresh = false) {
        if($refresh || empty($this->fieldDefs)) {
            $this->fieldDefs = \DB::table('eds_fields')->get();
        }

        return $this->fieldDefs;
    }
    
}