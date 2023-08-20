<?php
namespace app\Http\Controllers;

use App\Http\Controllers\Api\ApiResponse;
use App\Models\File;
use Illuminate\Http\Request;

Trait imageuploadtrait {
    use ApiResponse;
 public function upload(Request $request){
    // $request = Request::createFromBase($request);
    $filesr = $request->file();
    $result = [];


        if ($filesr) {
            $filename = time() . '_' . $filesr->getClientOriginalExtension();
            $file_path=$filesr->storeAs('public/uploads', $filename);

            $result['names'][] = $filename;
            $result['paths'][] = $file_path;
            return $result;
        }else{return $this->errorResponse('Faild this is not supported file extendtion');

        }


    }



}
