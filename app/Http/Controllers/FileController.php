<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use FileVault;
use Storage;
use Str;
use App\Models\File;
use DB;

class FileController extends Controller
{
    public function index()
    {
        $file = File::get();
        $files = Storage::files('files/' . auth()->user()->id);
        return view('dashboard', compact('files','file'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('userFile') && $request->file('userFile')->isValid()) {
            $filename = Storage::putFile('files/' . auth()->user()->id, $request->file('userFile'));
            // Check to see if we have a valid file uploaded
            if ($filename) {
                FileVault::encrypt($filename);
            
            $namafile = $request->file('userFile')->getClientOriginalName();
            //get file name
            $ukuranfile = $request->file('userFile')->getSize();

            $file = new File;
            $file -> nama_file = $namafile;
            $file -> ukuran_file = $ukuranfile;
            $file -> file = $filename.'.enc';
            $file -> user_id = auth()->user()->id;
            $file -> save();
            }
        }
        
        return redirect()->route('dashboard')->with('message', 'Upload complete');
    }

    public function downloadFile($filename)
    {
        // Basic validation to check if the file exists and is in the user directory
        if (!Storage::has('files/' . auth()->user()->id . '/' . $filename)) {
            abort(404);
        }

        return response()->streamDownload(function () use ($filename) {
            FileVault::streamDecrypt('files/' . auth()->user()->id . '/' . $filename);
        }, Str::replaceLast('.enc', '', $filename));
    }
}
