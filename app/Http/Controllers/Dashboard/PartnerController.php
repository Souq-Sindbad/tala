<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\PartnerDataTable;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Intervention\Image\Facades\Image;


class PartnerController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:partners-read'])->only('index', 'show');
        $this->middleware(['permission:partners-create'])->only('create', 'store');
        $this->middleware(['permission:partners-update'])->only('edit', 'update');
        $this->middleware(['permission:partners-delete'])->only('destroy');
    }//end of constructor

    public function index(PartnerDataTable $dataTable,Request $request){
        $data['title'] = __('site.partners');
        return $dataTable->render('dashboard.partners.index',compact('data'));
    }

    private function validate_page($request,$data = "")
    {
        $rules = [
            'url' => 'required',
            'type'  => 'required',
        ];
        foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules += [$locale . '_name' => ['required']];
        }//end of for each

        if(!$data){
            $rules +=[
                'image'  => 'required|image',
            ];
        }


        $validator = Validator::make($request->all(), $rules);

        return $validator;

    }

    public function show($id){
        $form_data = Partner::findOrFail($id);
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

            $request_data = [
                'name' => json_encode($name_array,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT),
                'url' => $request->url,
                'type' => $request->type,
                'status' => ($request->status) ? 1 :0
            ];
            if($request->image){
                $png_url = "partner-" . time() . ".png";
                $path = public_path() . '/uploads/partners/' . $png_url;
                Image::make(file_get_contents($request->image))->save($path);
                $request_data['image'] = $png_url;
            }
            Partner::create($request_data);
            return response()->json(array('success' => true), 200);
        }
    }

    public function edit($id)
    {
        $form_data = Partner::findOrFail($id);
        $returnHTML = view('dashboard.partners.partials._edit',compact('form_data'))->render();
        return $returnHTML;
    }

    public function update($id,Request $request)
    {
        $partner = Partner::findOrFail($request->id);
        $validator = $this->validate_page($request,$partner);
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

            $request_data = [
                'name' => json_encode($name_array,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT),
                'url' => $request->url,
                'type' => $request->type,
                'status' => ($request->status) ? 1 :0
            ];
            if($request->image){
                if($partner->image){
                    Storage::disk('public_uploads')->delete('/partners/' . $partner->image);
                }
                $png_url = "partner-" . time() . ".png";
                $path = public_path() . '/uploads/partners/' . $png_url;
                Image::make(file_get_contents($request->image))->save($path);
                $request_data['image'] = $png_url;
            }
            $partner->update($request_data);
            return response()->json(array('success' => true), 200);
        }
    }

    public function remove($id)
    {
        $partner = Partner::findOrFail($id);
        $partner->delete();
        return response()->json(array('success' => true));
    }

    public function active($id){
        $partner = Partner::findOrFail($id);
        $partner->update(['status' => 1]);
        return response()->json(array('success' => true));
    }

    public function block($id){
        $partner = Partner::findOrFail($id);
        $partner->update(['status' => 0]);
        return response()->json(array('success' => true));
    }
}
