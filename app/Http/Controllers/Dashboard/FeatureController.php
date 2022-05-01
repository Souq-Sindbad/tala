<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\FeatureDataTable;
use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class FeatureController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:features-read'])->only('index', 'show');
        $this->middleware(['permission:features-create'])->only('create', 'store');
        $this->middleware(['permission:features-update'])->only('edit', 'update');
        $this->middleware(['permission:features-delete'])->only('destroy');
    }//end of constructor

    public function index(FeatureDataTable $dataTable,Request $request){
        $data['title'] = __('site.features');
        return $dataTable->render('dashboard.features.index',compact('data'));
    }

    private function validate_page($request)
    {
        $rules = array();
        foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules += [$locale . '_name' => ['required']];
        }//end of for each


        $validator = Validator::make($request->all(), $rules);

        return $validator;

    }

    public function show($id){
        $form_data = Feature::findOrFail($id);
        return json_encode($form_data);
    }

    public function store(Request $request)
    {
        $validator = $this->validate_page($request);
        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 200);
        } else {
            $name_array = array();
            foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties) {

                $n = $locale."_name";
                $name_array[$locale] = $request->$n;
            }

            $request_data['name'] = json_encode($name_array,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            $request_data['status'] = ($request->status) ? 1 :0;
            Feature::create($request_data);
            return response()->json(array('success' => true), 200);
        }
    }

    public function edit($id)
    {
        $form_data = Feature::findOrFail($id);
        $returnHTML = view('dashboard.features.partials._edit',compact('form_data'))->render();
        return $returnHTML;
    }

    public function update($id,Request $request)
    {
        $feature = Feature::findOrFail($request->id);
        $validator = $this->validate_page($request);
        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 200);
        } else {
            $name_array = array();
            foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties) {

                $n = $locale."_name";
                $name_array[$locale] = $request->$n;
            }

            $request_data['name'] = json_encode($name_array,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            $request_data['status'] = ($request->status) ? 1 :0;
            $feature->update($request_data);
            return response()->json(array('success' => true), 200);
        }
    }

    public function remove($id)
    {
        $feature = Feature::findOrFail($id);
        $feature->delete();
        return response()->json(array('success' => true));
    }

    public function active($id){
        $feature = Feature::findOrFail($id);
        $feature->update(['status' => 1]);
        return response()->json(array('success' => true));
    }

    public function block($id){
        $feature = Feature::findOrFail($id);
        $feature->update(['status' => 0]);
        return response()->json(array('success' => true));
    }
}
