<?php

namespace App\Models;

use App\Functions\ImagesFunctions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'short_desc',
        'description',
        'address',
        'image',
        'status'
    ];

    protected $appends = ['image_path'];
    public function getImagePathAttribute(){
        if($this->image)
            return  asset('public/uploads/projects/'.$this->image);
        else
            return  asset('public/uploads/projects/placeholder.png');
    }

    public function getImageSize($size_width, $size_height)
    {
        $image =  asset('public/uploads/projects/' . $this->image);
        if($image!=''){
            $image = str_replace(asset('public/uploads/projects').'/', '', $image);
            if(strpos($image, 'placeholder.png')){
                return $image;
            }
            $images_functions = new ImagesFunctions();
            $new_image = $images_functions->getNewSizeFromImage('projects', $image, $size_width, $size_height);
            if($new_image!=''){
                return asset('public/uploads/projects/' . $new_image);
            } else {
                return asset('public/uploads/photo.svg');
            }
        } else {
            return asset('public/uploads/photo.svg');
        }
    }//end of image path attribute

    public function getTranslateName($local  = 'ar'){
        $name = "";
        try {
            $array = json_decode($this->name,TRUE);
            $name = $array[$local];
        }catch (\Exception $ex){

        }
        return $name;
    }

    public function getTranslateShort($local  = 'ar'){
        $name = "";
        try {
            $array = json_decode($this->short_desc,TRUE);
            $name = $array[$local];
        }catch (\Exception $ex){

        }
        return $name;
    }

    public function getTranslateDesc($local  = 'ar'){
        $name = "";
        try {
            $array = json_decode($this->description,TRUE);
            $name = $array[$local];
        }catch (\Exception $ex){

        }
        return $name;
    }

    public function getTranslateAddress($local  = 'ar'){
        $name = "";
        try {
            $array = json_decode($this->address,TRUE);
            $name = $array[$local];
        }catch (\Exception $ex){

        }
        return $name;
    }
}
