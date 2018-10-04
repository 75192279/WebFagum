<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request){
        $esploded=explode(',',$request->fileUpload);
        $decoded=base64_decode($esploded[1]);
        if(str_contains($esploded[0],'jpeg'))
            $extension='jpg';
        else if(str_contains($esploded[0],'png'))
            $extension='png';
        $fileName=str_random().'.'.$extension;
        $path=public_path().'/storage'.'/'.$fileName;
        file_put_contents($path,$decoded);

        if($extension=='jpg')
            $image_new=imagecreatefromjpeg($path);
        else if($extension=='png')
            $image_new=imagecreatefrompng($path);
        $width_origin=imagesx($image_new);
        $height_origin=imagesy($image_new);
        $width_thumbnail=150;
        $width_medium=300;
        $width_large=1024;
        
        $size_thumbnail=$this->size_upload($width_thumbnail,$width_origin,$height_origin);
        $size_medium=$this->size_upload($width_medium,$width_origin,$height_origin);
        $size_large=$this->size_upload($width_large,$width_origin,$height_origin);

        $image_thumbnail=$this->new_image($size_thumbnail,$image_new,$extension,$fileName);     
        $image_medium=$this->new_image($size_medium,$image_new,$extension,$fileName);     
        $image_large=$this->new_image($size_large,$image_new,$extension,$fileName);

        list($width, $height, $type, $attr) = getimagesize($path);

        return json_encode(['full'=>$fileName,'thumbnail'=>$image_thumbnail,'medium'=>$image_medium,'large'=>$image_large]);
    }
    function size_upload($size,$width_origin,$height_origin){
        $size_origin=$size;
        if($width_origin>$height_origin){
            $width=$size;
            $height=$size*$height_origin/$width_origin;
        }
        else{
            $height=$size;
            $width=$size*$width_origin/$height_origin;
        }
        return (object) array('width'=>$width,'height'=>$height);

    }
    function new_image($object,$image,$extension,$name){
        $name_image=$name.'-'.$object->width.'x'.$object->height;
        $image_new=imagecreatetruecolor($object->width,$object->height);
        imagecopyresized($image_new,$image,0,0,0,0,$object->width,$object->height,imagesx($image),imagesy($image));
        
        if($extension=='jpg'){
            $new_name_image=$name_image.'.jpg';
            imagejpeg($image_new,'storage/'.$new_name_image);
        }
        else if($extension=='png'){
            $new_name_image=$name_image.'.png';
            imagepng($image_new,'storage/'.$new_name_image);
        }
        imagedestroy($image_new);
        return $new_name_image;
    }
    function resize_imagejpg($file, $w, $h, $finaldst) {

        list($width, $height) = getimagesize($file);
        $src = imagecreatefromjpeg($file);
        $ir = $width/$height;
        $fir = $w/$h;
        if($ir >= $fir){
            $newheight = $h; 
            $newwidth = $w * ($width / $height);
        }
        else {
            $newheight = $w / ($width/$height);
            $newwidth = $w;
        }   
        $xcor = 0 - ($newwidth - $w) / 2;
        $ycor = 0 - ($newheight - $h) / 2;
     
     
        $dst = imagecreatetruecolor($w, $h);
        $white = imagecolorallocate($dst, 255, 255, 255);
        imagefill($dst, 0, 0, $white);
        imagecopyresized($dst, $src, $xcor, $ycor, 0, 0, $newwidth, $newheight, 
        $width, $height);
        imagejpeg($dst, 'storage/150x150-'.$finaldst);
        imagedestroy($dst);
        return $file;
     }
     
}
