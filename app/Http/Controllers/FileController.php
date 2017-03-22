<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function kml(Request $request){
        try {
            $file = $request->file('kml_file');
            $fileName = $file->getClientOriginalName();
            $filePath = 'kml';
            $s3Name = $filePath .'/'. $fileName;

            if (Storage::disk('s3')->exists($s3Name)){
                Storage::disk('s3')->delete($s3Name);
            }

            $request->file('kml_file')->storeAs($filePath, $fileName, ['disk' => 's3', 'visibility' => 'public']);

            return response()->json([
                's3Name' => $s3Name
            ], 200);
        } 
        catch (Exception $ex) {
           return response()->json([
                'message' => $ex->getMessage()
            ], 400); 
        }
    }
}
