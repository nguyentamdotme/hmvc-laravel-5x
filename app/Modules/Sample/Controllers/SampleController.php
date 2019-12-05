<?php

namespace Modules\Sample\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Date;

class SampleController extends Controller
{
    public function index(){
        $moduleName = config("sample.module_name");
        $today = Date::get();
        $data = compact("moduleName", "today");
        return view('Sample::index', $data);
    }
}
