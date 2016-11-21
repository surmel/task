<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\People;
use DB;
use Validator;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function index(){       
        return view('welcome');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required',
            'last_name' => 'required',
            'keyword' => 'required',            
            'file' => 'required|mimes:doc,docx,pdf,txt',
        ]);
    }
    
    public function addHuman(Request $request){
        $this->validator($request->all())->validate();
        if($request->file('file')){
            $file_extension = $request->file('file')->getClientOriginalExtension();
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $keyword = $request->input('keyword');

            $file_name = $request->file('file')->getClientOriginalName();
            $current_date = Carbon::now();
            $file_name = md5($current_date->toDateTimeString()).'.'.$file_extension;
            $request->file('file')->move(base_path().'/public/files/', $file_name);
            $data = [   'first_name' => $first_name,
                        'last_name'  => $last_name,
                        'keywords'   => $keyword,
                        'cv'         => $file_name,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
            $people = new People;

            $result = $people->addPerson($data);
            if($result){
                Session::flash('success', 'Person information was successfully added');
                return redirect('/');
            }
            else {
                Session::flash('error', 'Something went wrong! Please try again.');
                return redirect('/');
            }
            
        }
        
    }
    
    public function searchHuman(Request $request){
        $first_name = $request->input('search_first_name');
        $last_name = $request->input('search_last_name');
        $keyword = $request->input('search_keyword');
        if($first_name == "" && $last_name == "" && $keyword == ""){
            Session::flash('error', 'Fill at least one field!');
            return redirect('/');
        }
        $people = new People;
        $result = $people->searchPerson($first_name, $last_name, $keyword);
              
        return view('welcome')->with('result', $result);
    }
    
    public function download($filename){
        $file= public_path()."/files/".$filename;
        return response()->download($file);
    }
}
