<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AppController extends Controller {

		public function show($base){
            // // if multiple landing page or if not fully single page application :)

                $baseurl = explode("/",$base);

                if($baseurl[0] == "admin"){
                     return view('admin.index');
                }else{
                     return view('shop.index');
                }
        
    	}

    	public function uploadtest(Request $request){
    		    $fileName = time().'.'.$request->file->getClientOriginalExtension();
    		    $fileName =  time().'_'.$request->file->getClientOriginalName();

		        $request->file->move(public_path('upload'), $fileName);

		              
		        unlink(public_path('upload').'/'.$fileName);
		        return response()->json(['success'=>'You have successfully upload file.'.$request->name]);
    	}

}
