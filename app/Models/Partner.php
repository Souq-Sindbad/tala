<?php

namespace App\Models;

use App\Functions\ImagesFunctions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name','url','image','type','status'];
    protected $appends = ['image_path'];

    public function getTranslateName($local  = 'ar'){
        $name = "";
        try {
            $array = json_decode($this->name,TRUE);
            $name = $array[$local];
        }catch (\Exception $ex){

        }
        return $name;
    }

    public function getImagePathAttribute(){
        if($this->image)
            return  asset('public/uploads/partners/'.$this->image);
        else
            return  asset('public/uploads/partners/placeholder.png');
    }

    public function getImageSize($size_width, $size_height)
    {
        $image =  asset('public/uploads/partners/' . $this->image);
        if($image!=''){
            $image = str_replace(asset('public/uploads/partners').'/', '', $image);
            if(strpos($image, 'placeholder.png')){
                return $image;
            }
            $images_functions = new ImagesFunctions();
            $new_image = $images_functions->getNewSizeFromImage('partners', $image, $size_width, $size_height);
            if($new_image!=''){
                return asset('public/uploads/partners/' . $new_image);
            } else {
                return asset('public/uploads/photo.svg');
            }
        } else {
            return asset('public/uploads/photo.svg');
        }
    }//end of image path attribute
}
