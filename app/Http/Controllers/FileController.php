<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class FileController extends Controller
{
    /**
     * Upload a new file
     */
    public function upload(Request $request): JsonResponse
    {
        if($request->file('file')->isValid())
        {
            $random = Str::random(10);
            $newFileName = $request->file('file')->getClientOriginalName() . '_' . $random;
            
            $request->file('file')->storeAs('files', $newFileName);
            $newFile = File::create([
                'owner_id' => auth('sanctum')->user()->id,
                'physical_path' => $newFileName,
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'content_length' => $request->file('file')->getSize(),
            ]);
            $newFile->save();
            
            return response()->json($newFile);
        } 
        else 
        {
            return response()->json(array('result' => 'failed'));
        }
    }

    /**
     * delete file both from storage and database
     */
    public function delete(Request $request): JsonResponse
    {
        $fID = $request->id;
        $file = File::find($fID)->where('owner_id', '=', auth('sanctum')->user()->id)->firstOrFail();
        Storage::delete('files/' . $file->physical_path);
        $file->delete();
        return response()->json(array(
            'result' => 'success'
        ));
    }

    public function download(Request $request)
    {
        $fID = $request->id;
        $file = File::find($fID)->first();

        if($file->owner_id == auth('sanctum')->user()->id)
        {
            return Storage::download('files/' . $file->physical_path);
        }
        else
        {
            return response()->json(array(
                'result' => 'failed',
                'reason' => 'NO_PERMISSION'
            ));
        }
        
    }
}
