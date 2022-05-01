<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Benefit;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Slide;
use App\Models\Statistic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function index(){
        $data['title'] = __('site.home');
        $data['counter']['features'] = Feature::count();
        $data['counter']['statistics'] = Statistic::count();
        $data['counter']['projects'] = Project::count();
        $data['counter']['partners'] = Partner::count();
        $data['counter']['benefits'] = Benefit::count();
        return view('dashboard.index', compact('data'));
    }

    public function profile(Request $request){
        $data['title'] = __('site.profile');
        return view('dashboard.user.profile', compact('data'));
    }

    public function update_profile(Request $request){
        $user = User::find(Auth::user()->id);
        if($user){
            $rules = [
                'name' => 'required',
                'email' => [ 'required','email',
                    Rule::unique('users')->ignore($user->id, 'id')
                ]
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()

                ), 200);
            }

            $data['name'] = $request->name;
            $data['email'] = $request->email;

            if($request->image){
                $png_url = "user-" . time() . ".png";
                $path = public_path() . '/uploads/users/' . $png_url;
                Image::make(file_get_contents($request->image))->save($path);
                $data['image'] = $png_url;
            }

            $user->update($data);
            return response()->json(array('success' => true), 200);

        }else{
            return response()->json(array('success' => false), 200);
        }
    }

    public function change_password(Request $request){
        $user = Auth()->user();

        $rules = [
            'new_password' => 'required|string|min:6|confirmed',
            'old_password'=> 'required|string|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);

        $oldpassword = $request->input('old_password');
        if (!Hash::check($oldpassword,$user->password)) {
            return response()->json(array('success' => 3,'msg' => __('site.err_old_password')), 200);
        }

        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 200);
        }

        $user->password = Hash::make($request['password']);
        $user->save();
        return response()->json(array('success' => true), 200);

    }
}
