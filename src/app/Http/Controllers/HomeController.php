<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Image;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $img = Image::all();
        return view('home', ['imgs' => $img]);
    }

    /**
     * ファイルアップロード処理
     */
    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => [
                // 必須
                'required',
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpeg,png',
            ]
        ]);

        // $path = $request->input('file')
        // Image::insert(["path" => $path])

        if ($request->file('file')->isValid([])) {
            $path = $request->file->store('public');
            Image::insert(["path" => $path]);
            return view('home')->with('filename', basename($path));
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors();
        }
    }
}