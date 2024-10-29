<?php

namespace App\Http\Controllers\Api;

use App\Models\UploadFile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Jobs\ProcessInfoFileJob;

class UploadFileController extends Controller
{
    public function upload(Request $request){

        $request->validate([
            'file' => [
                'required',
                'file',
                function ($attribute, $value, $fail) {
                    $allowedMimeTypes = [
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 
                        'text/csv', 
                        'text/plain'
                    ];
                    
                    if (!in_array($value->getMimeType(), $allowedMimeTypes)) {
                        return $fail('O arquivo deve ser do tipo xlsx, csv ou text/csv.');
                    }
                },
            ],
        ]);

        $fileUpload = $request->file('file');
        $originalName = $fileUpload->getClientOriginalName();

        //dd($originalName);
        if (UploadFile::where('original_filename', $originalName)->exists()) {
            return response()->json(['error' => 'Arquivo já enviado anteriormente.'], 409);
        }


        $filename = Str::uuid() . '.' . $fileUpload->getClientOriginalExtension();
        $filePath = $fileUpload->storeAs('uploads', $filename);

        $uploadFile = UploadFile::create([
            'filename' => $filename,
            'original_filename' => $originalName,
            'file_path' => $filePath,
        ]);

        ProcessInfoFileJob::dispatch($uploadFile->id);

        return response()->json(['message' => 'Upload realizado com sucesso!', 'data' => $fileUpload], 201);

    }
}
