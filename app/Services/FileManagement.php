<?php

namespace App\Services;
use Illuminate\Support\Facades\Storage;

class FileManagement
{
    public function uploadFile(
        string $path, 
        $file = null,
        array $files = null,
        array $appendFilesTo = array(), 
        bool $deleteOldFile = false, 
        string $oldFile = null, 
        string $storeAsName = ''
        )
    {
        if(!empty($files)){   
            foreach ($files as $file) {
                array_push($appendFilesTo,$file->store($path));
            }
            return $appendFilesTo;

        } 
        else if(!empty($file) && !empty($file->extension() ?? ''))
        {
            if($deleteOldFile){
                if(Storage::disk('public')->exists($oldFile)){
                    Storage::delete($oldFile);
                }
            }
            if(empty($storeAsName)){
                $storeAsName = $file->getClientOriginalName();
            } else {
                $storeAsName = $storeAsName.'.'.$file->extension();
            }
            return $file->storeAs($path,$storeAsName);
        }
        else {
            dd('No file/files given to uploadFile() in FileManagement Service!');
            return false;
        }
    }

    public function deleteFile(string $fileUrl,array $oldFilesArray = array())
    {
        parse_url($fileUrl)['host'] === 'images.pexels.com' ? $file = $fileUrl :   $file = substr(parse_url($fileUrl)['path'],1);

        if(!empty($oldFilesArray)){
            if (($key = array_search($file, $oldFilesArray)) !== false) {
                unset($oldFilesArray[$key]);
                if(parse_url($fileUrl)['host'] !== 'images.pexels.com'){
                    Storage::delete($file);
                }
            }
            $newFiles = array_values($oldFilesArray);
            return $newFiles;
        } else {
            if(Storage::exists($fileUrl)){
                Storage::delete($fileUrl);
            }
            $newFile = '';
            return $newFile;
        }
    }

    public function moveFiles(string $oldPath, string $newPath, string $deleteDirectory = '' )
    {
        Storage::move($oldPath, $newPath);
        if(!empty($deleteDirectory)) {
            Storage::deleteDirectory($deleteDirectory);
        }
        
    }
}