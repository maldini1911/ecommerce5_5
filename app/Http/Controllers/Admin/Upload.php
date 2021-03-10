<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;
use App\File;

class Upload extends Controller
{
    

 public function upload($data = []){

if(in_array('new_name', $data)){ $new_name = $data['new_name'] === null ? time():$data['new_name']; }

        if(request()->hasFile($data['file']) && $data['upload_type'] == 'single'){
        
        Storage::has($data['delete_file'])?Storage::delete($data['delete_file']):'';
        
        return request()->file($data['file'])->store($data['path']);
        
        }
        elseif(request()->hasFile($data['file']) && $data['upload_type'] == 'files')
        {
            $file = request()->file($data['file']);
            $name = $file->getClientOriginalName();
            $size = $file->getSize();
            $mimie_type = $file->getMimeType();
            $hash_name = $file->hashName();
            
            $file->store($data['path']);
            
            $add = File::create([
                'name'          => $name,
                'size'          => $size,
                'file'          => $hash_name,
                'path'          => $data['path'],
                'full_file'     => $data['path'] . '/' . $hash_name,
                'mime_type'     => $mimie_type,
                'file_type'     => $data['file_type'],
                'relation_id'   => $data['relation_id']
            ]);

                return $add->id;
        }

    }


//=== Function Delete File ===
public function delete($id)
{
    $file = File::find($id);
    if(!empty($file)){
        Storage::delete($file->full_file);
        $file->delete();
    }
   
}    

      
}


