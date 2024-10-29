<?php

namespace App\Http\Controllers\Api;

use App\Models\UploadFile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function history_upload(Request $request){
        $request->validate([
            'filename' => 'string|nullable',
            'reference_date' => 'date|nullable',
        ]);

        $queryFilter = UploadFile::query();

        if ($request->filled('original_filename')) {
            $queryFilter->where('original_filename', 'like', '%' . $request->filename . '%');
        }

        if ($request->filled('created_at')) {
            $queryFilter->whereDate('created_at', $request->reference_date);
        }

        $uploads = $queryFilter->paginate(10);

        return response()->json($uploads);
    }
}
