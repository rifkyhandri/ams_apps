<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Menu;

use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    //

    public function index(){
        return view('auth.user');
    }

    public function user_list(){
        // $user = User::whereNotIn('id', array(1, 2))->get();
        $user = User::orderBy('created_at','desc')->get();
        return Datatables::of($user)->make(true);
    }

    public function user_input(Request $request){

        $validation_value = [
            'name'           => 'required|regex:/^[a-zA-Z ]+$/|min:5|max:50',
            'role'           => 'required',
            'email'          => 'required|email|min:5|max:30|unique:users',
            'password'       => 'required|min:6|max:25',
            'repassword'     => 'required|same:password'
        ];

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal menambah data','errors' => $validator->errors()],422);
        }

        $data = [
                    'name'            => $request->name,
                    'role'            => $request->role,
                    'email'           => $request->email,
                    'password'        => Hash::make($request->password)
        ];


        $insert = User::create($data);

        if($insert){
            return response()->json(['message'=>'Berhasil menambah data!'],200);
        }else{
            return response()->json(['message'=>'Gagal menambah data','errors' => $insert],422);
        }

    }

    public function user_edit(Request $request){
        $user = User::find($request->id);
        return response()->json($user);
    }

    public function user_update(Request $request){

        $id = $request->id;

        $users = User::where('id',$id)->get()->first();

        $data = [
                    'name'            => $request->name,
                    'role'            => $request->role
                ];

        $validation_value = [
                'name' => 'required|regex:/^[a-zA-Z ]+$/|min:5|max:50',
                'role' => 'required',
        ];

        if(!empty($request->password)){
            $validation_value += [
                'password' => 'required|min:6|max:25',
                'repassword' => 'required|same:password'
            ];
            $data += [
                'password' => bcrypt($request->password)
            ];
        }

        if(!empty($request->email) ){
            if($request->email != $users->email){
                $validation_value +=  [
                    'email'           => 'required|email|min:5|max:30|unique:users',
                ];
                $data += [
                    'email' => $request->email
                ];
            }
        }else{
            $validation_value +=  [
                'email'           => 'required|email|min:5|max:30|unique:users',
            ];
        }

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return response()->json(['message'=>'Gagal mengubah data','errors' => $validator->errors()],422);
        }

        $update = User::where('id',$id)->update($data);

        if($update){
            return response()->json(['message'=>'Berhasil mengubah data'],200);
        }else{
            return response()->json(['message'=>'Gagal mengubah data','errors' => $update],422);
        }
    }

    public function user_delete(Request $request,$id){
        $user = User::find($id);
        $user->delete();
    }

    public function user_import(Request $request){

        if ($request->hasFile('file')) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($request->file->path());
            $activeSheet = $spreadsheet->getActiveSheet();
            $endRow = $activeSheet->getHighestRow();
            //dd($endRow);

            //dd($cekdata);
            for($i=2;$i<=$endRow; $i++) {
                $datanama = $activeSheet->getCell("B{$i}")->getValue();
                $dataemail = $activeSheet->getCell("C{$i}")->getValue();
                $datapassword = $activeSheet->getCell("D{$i}")->getValue();
                $datanote = $activeSheet->getCell("E{$i}")->getValue();
                //dd($datanama);


                $user = new User;
                $user->name = $datanama;
                $user->email = $dataemail;
                $user->password = Hash::make($datapassword);
                $user->note = $datanote;
                $user->save();
            }
            /* dd($datanama); */
            return response('success');



        }else{
            return response('file tidak seusai');
        }
    }

    public function settings(){

        $id = Auth::user()->id;
        $user = User::where('id',$id)->get();

        return view('auth.settings',['user'=>$user]);
    }

    public function setting_update(Request $request){

        $id = Auth::user()->id;

        $users = User::where('id',$id)->get()->first();
        //
        $data = [
                    'name'            => $request->name,
                    'role'            => $request->role
                ];

        $validation_value = [
                'name' => 'required|regex:/^[a-zA-Z ]+$/|min:5|max:50',
                'role' => 'required',
        ];

        if(!empty($request->password)){
            $validation_value += [
                'password' => 'required|min:6|max:25',
                'repassword' => 'required|same:password'
            ];
            $data += [
                'password' => bcrypt($request->password)
            ];
        }

        if(!empty($request->email) ){
            if($request->email != $users->email){
                $validation_value +=  [
                    'email'           => 'required|email|min:5|max:30|unique:users',
                ];
                $data += [
                    'email' => $request->email
                ];
            }
        }else{
            $validation_value +=  [
                'email'           => 'required|email|min:5|max:30|unique:users',
            ];
        }

        $validator = Validator::make($request->all(),$validation_value);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = User::where('id',$id)->update($data);

        if($data){
            return redirect('settings')->with('alert-success','Berhasil mengubah data.');
        }else{
            return redirect('settings')->with('alert-success','Gagal mengubah data.');
        }
    }

    public function login_post(Request $request){

        $identity = $request->get("email");
        $password = $request->get("password");

        if (Auth::attempt([
            filter_var($identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'name' => $identity, 'password' => $request->password
            ]))
        {
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('login_view')
                            ->withErrors(['login' => 'The email or password you’ve entered is incorrect.!'])
                            ->withInput();
        }
    }

    public function logout(){

        Auth::logout();

        return redirect()->route('login_view')->withErrors(['logout' => 'Berhasil keluar dari sistem!']);
    }



}
