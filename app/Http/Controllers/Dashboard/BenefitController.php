<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\BenefitDataTable;
use App\Http\Controllers\Controller;
use App\Models\Benefit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class BenefitController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:benefits-read'])->only('index', 'show');
        $this->middleware(['permission:benefits-create'])->only('create', 'store');
        $this->middleware(['permission:benefits-update'])->only('edit', 'update');
        $this->middleware(['permission:benefits-delete'])->only('destroy');
    }//end of constructor

    public function index(BenefitDataTable $dataTable,Request $request){
        $data['title'] = __('site.benefits');
        return $dataTable->render('dashboard.benefits.index',compact('data'));
    }

    private function validate_page($request)
    {
        $rules = array();
        foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules += [$locale . '_name' => ['required']];
            $rules += [$locale . '_description' => ['required']];
        }//end of for each


        $validator = Validator::make($request->all(), $rules);

        return $validator;

    }

    public function show($id){
        $form_data = Benefit::findOrFail($id);
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
            $desc_array = array();
            foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties) {

                $n = $locale."_name";
                $d = $locale."_description";
                $name_array[$locale] = $request->$n;
                $desc_array[$locale] = $request->$d;
            }

            $request_data['name'] = json_encode($name_array,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            $request_data['description'] = json_encode($desc_array,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            $request_data['status'] = ($request->status) ? 1 :0;
            Benefit::create($request_data);
            return response()->json(array('success' => true), 200);
        }
    }

    public function edit($id)
    {
        $form_data = Benefit::findOrFail($id);
        $returnHTML = view('dashboard.benefits.partials._edit',compact('form_data'))->render();
        return $returnHTML;
    }

    public function update($id,Request $request)
    {
        $benefit = Benefit::findOrFail($request->id);
        $validator = $this->validate_page($request);
        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 200);
        } else {
            $name_array = array();
            $desc_array = array();
            foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties) {

                $n = $locale."_name";
                $d = $locale."_description";
                $name_array[$locale] = $request->$n;
                $desc_array[$locale] = $request->$d;
            }

            $request_data['name'] = json_encode($name_array,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            $request_data['description'] = json_encode($desc_array,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            $request_data['status'] = ($request->status) ? 1 :0;
            $benefit->update($request_data);
            return response()->json(array('success' => true), 200);
        }
    }

    public function remove($id)
    {
        $benefit = Benefit::findOrFail($id);
        $benefit->delete();
        return response()->json(array('success' => true));
    }

    public function active($id){
        $benefit = Benefit::findOrFail($id);
        $benefit->update(['status' => 1]);
        return response()->json(array('success' => true));
    }

    public function block($id){
        $benefit = Benefit::findOrFail($id);
        $benefit->update(['status' => 0]);
        return response()->json(array('success' => true));
    }
}
