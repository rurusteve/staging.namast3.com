<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function forminsert(Request $request)
    {
        return view('insertfile');
    }
    public function process(Request $request)
    {
        $path = $request->file('fileketerangan')->store('/Applications/XAMPP/xamppfiles/htdocs/Payrolling/public/fileketerangan');

        return $path;
    }
    public function index(): View
    {
        $files = File::orderBy('created_at', 'DESC')
            ->paginate(30);

        return view('index', compact('files'));
    }

    public function form($id): View
    {
        $employees = MasterEmployee::where('nip','=',$id)->first();
        return view('form', ['employees'=>$employees]);
    }
    public function ppform($id): View
    {
        $employees = MasterEmployee::where('nip','=',$id)->first();
        return view('profilepictureform', ['employees'=>$employees]);
    }

    public function upload(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'title' => 'nullable|max:100',
            'file' => 'required|file|max:2000'
        ]);
        $uploadedFile = $request->file('file');
        $path = $uploadedFile->store('public/files');
        $file = File::create([
            'title' => $request->title ?? $uploadedFile->getClientOriginalName(),
            'nip' => $id,
            'filename' => $path
        ]);
        return redirect()
            ->back()
            ->withSuccess(sprintf('File %s has been uploaded.', $file->title));
    }
    public function uploadprofilepicture(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'picture' => 'required|file|max:2000'
        ]);
        $uploadedFile = $request->file('picture');
        $path = $uploadedFile->store('public/files');
        $employees = MasterEmployee::where('nip', '=', $id)->first();
        $file = ProfilePicture::create([
            'nip' => $id ?? $uploadedFile->getClientOriginalName(),
            'picture' => $path
        ]);
        return redirect()
            ->back()
            ->withSuccess(sprintf('Upload success', $request->nip));
    }
}
