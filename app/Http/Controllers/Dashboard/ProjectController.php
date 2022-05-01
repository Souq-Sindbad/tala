<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\ProjectDataTable;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ProjectController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:projects-read'])->only('index', 'show');
        $this->middleware(['permission:projects-create'])->only('create', 'store');
        $this->middleware(['permission:projects-update'])->only('edit', 'update');
        $this->middleware(['permission:projects-delete'])->only('destroy');
    }//end of constructor

    public function index(ProjectDataTable $dataTable,Request $request){
        $data['title'] = __('site.projects');
        return $dataTable->render('dashboard.projects.index',compact('data'));
    }

    private function validate_page($request,$data = "")
    {
        $rules = array();
        foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules += [$locale . '_name' => ['required']];
            $rules += [$locale . '_short_desc' => ['required']];
            $rules += [$locale . '_description' => ['required']];
            $rules += [$locale . '_address' => ['required']];
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
        $form_data = Project::findOrFail($id);
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
            $description_array = array();
            $short_desc_array = array();
            $address_array = array();
            foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $n = $locale."_name";
                $name_array[$locale] = $request->$n;

                $s = $locale."_short_desc";
                $short_desc_array[$locale] = $request->$s;

                $a = $locale."_address";
                $address_array[$locale] = $request->$a;

                $d = $locale."_description";
                $description_array[$locale] = $request->$d;
            }



            $request_data = [
                'name' => json_encode($name_array,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT),
                'description' => json_encode($description_array,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT),
                'address' => json_encode($address_array,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT),
                'short_desc' => json_encode($short_desc_array,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT),
                'status' => ($request->status) ? 1 :0
            ];
            if($request->image){
                $png_url = "project-" . time() . ".png";
                $path = public_path() . '/uploads/projects/' . $png_url;
                Image::make(file_get_contents($request->image))->save($path);
                $request_data['image'] = $png_url;
            }
            Project::create($request_data);
            return response()->json(array('success' => true), 200);
        }
    }

    public function edit($id)
    {
        $form_data = Project::findOrFail($id);
        $returnHTML = view('dashboard.projects.partials._edit',compact('form_data'))->render();
        return $returnHTML;
    }

    public function update($id,Request $request)
    {
        $project = Project::findOrFail($request->id);
        $validator = $this->validate_page($request,$project);
        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 200);
        } else {
            $name_array = array();
            $description_array = array();
            $short_desc_array = array();
            $address_array = array();
            foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $n = $locale."_name";
                $name_array[$locale] = $request->$n;

                $s = $locale."_short_desc";
                $short_desc_array[$locale] = $request->$s;

                $a = $locale."_address";
                $address_array[$locale] = $request->$a;

                $d = $locale."_description";
                $description_array[$locale] = $request->$d;
            }



            $request_data = [
                'name' => json_encode($name_array,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT),
                'description' => json_encode($description_array,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT),
                'address' => json_encode($address_array,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT),
                'short_desc' => json_encode($short_desc_array,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT),
                'status' => ($request->status) ? 1 :0
            ];
            if($request->image){
                if($project->image){
                    Storage::disk('public_uploads')->delete('/projects/' . $project->image);
                }
                $png_url = "project-" . time() . ".png";
                $path = public_path() . '/uploads/projects/' . $png_url;
                Image::make(file_get_contents($request->image))->save($path);
                $request_data['image'] = $png_url;
            }
            $project->update($request_data);
            return response()->json(array('success' => true), 200);
        }
    }

    public function remove($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return response()->json(array('success' => true));
    }

    public function active($id){
        $project = Project::findOrFail($id);
        $project->update(['status' => 1]);
        return response()->json(array('success' => true));
    }

    public function block($id){
        $project = Project::findOrFail($id);
        $project->update(['status' => 0]);
        return response()->json(array('success' => true));
    }
}
