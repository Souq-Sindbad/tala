<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\StatisticDataTable;
use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class StatisticController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:statistics-read'])->only('index', 'show');
        $this->middleware(['permission:statistics-create'])->only('create', 'store');
        $this->middleware(['permission:statistics-update'])->only('edit', 'update');
        $this->middleware(['permission:statistics-delete'])->only('destroy');
    }//end of constructor

    public function index(StatisticDataTable $dataTable,Request $request){
        $data['title'] = __('site.statistics');
        return $dataTable->render('dashboard.statistics.index',compact('data'));
    }

    private function validate_page($request)
    {
        $rules = [
            'counter' => 'required'
        ];
        foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules += [$locale . '_name' => ['required']];
        }//end of for each


        $validator = Validator::make($request->all(), $rules);

        return $validator;

    }

    public function show($id){
        $form_data = Statistic::findOrFail($id);
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
            $request_data['counter'] = $request->counter;
            $request_data['name'] = json_encode($name_array,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            $request_data['status'] = ($request->status) ? 1 :0;
            Statistic::create($request_data);
            return response()->json(array('success' => true), 200);
        }
    }

    public function edit($id)
    {
        $form_data = Statistic::findOrFail($id);
        $returnHTML = view('dashboard.statistics.partials._edit',compact('form_data'))->render();
        return $returnHTML;
    }

    public function update($id,Request $request)
    {
        $statistic = Statistic::findOrFail($request->id);
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
            $request_data['counter'] = $request->counter;
            $request_data['name'] = json_encode($name_array,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            $request_data['status'] = ($request->status) ? 1 :0;
            $statistic->update($request_data);
            return response()->json(array('success' => true), 200);
        }
    }

    public function remove($id)
    {
        $statistic = Statistic::findOrFail($id);
        $statistic->delete();
        return response()->json(array('success' => true));
    }

    public function active($id){
        $statistic = Statistic::findOrFail($id);
        $statistic->update(['status' => 1]);
        return response()->json(array('success' => true));
    }

    public function block($id){
        $statistic = Statistic::findOrFail($id);
        $statistic->update(['status' => 0]);
        return response()->json(array('success' => true));
    }
}
