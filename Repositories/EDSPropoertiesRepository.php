<?php

namespace App\Repositories;

use Modules\Base\Repository\BaseRepository;
use Illuminate\Http\Request;

class EDSPropoertiesRepository {

    protected $query;

    public function __construct() {

    }

    public function get($prop) {
        $prop = \DB::table('eds_properties')->where('name', $prop)->first();
        return ($prop) ? $prop->value : 'Untitled';
    }

}
