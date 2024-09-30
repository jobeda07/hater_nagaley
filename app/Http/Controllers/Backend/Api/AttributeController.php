<?php

namespace App\Http\Controllers\Backend\Api;

use App\Helpers\Classes\Combinations;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index(Request $request)
    {
        $options = [];
        foreach ($request->get('choice_attributes') as $key => $no) {
            $name = 'choice_options' . $no;
            $data = array();
            if ($request[$name] && sizeof($request[$name])>0) {
                foreach ($request[$name] as $key => $item) {
                    array_push($data, $item);
                }
                array_push($options, $data);
            }
        }
        $combinations = Combinations::makeCombinations($options);

        $data = [];
        foreach ($combinations as $combination) {
            $data[implode('-', $combination)] = rand(10, 100);
        }

        return response()->json(['success' => true, 'data' => $data]);
    }
}
