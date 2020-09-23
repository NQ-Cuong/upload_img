<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tests.index',["image_r" => ['/move/uploads/5f6b7267ee740_Capture.PNG','/move/uploads/5f6b726899caf_Untitled.png']]);
    }

    public function store(Request $request)
    {
        dd($request->all());
        foreach ($request->document as $doc) {
            mkdir(public_path('/move/uploads/'), 0777, true);
            File::move(public_path('/tmp/uploads/'.$doc), public_path('/move/uploads/').$doc);
        }
        return view('tests.index');
//        return response()->json(['success'=>$avatarName]);
    }

    public function storeMedia(Request $request)
    {
        $path = public_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
}
