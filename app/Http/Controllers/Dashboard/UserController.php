<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ValidatorRequest;
use App\Http\Requests\UpdateDataValidation;
use Intervention\Image\Facades\Image;
use App\Helper\Trait\General;
use Illuminate\Support\Facades\File;
use Auth;


class UserController extends Controller
{
    use General;
    
    public function __construct(){
        // only(['func1','func2]) => can take array of function
        $this->middleware(['permission:users_read'])->only('index');
        $this->middleware(['permission:users_create'])->only('create');
        $this->middleware(['permission:users_update'])->only('edit');
        $this->middleware(['permission:users_delete'])->only('destroy');

    }
   
    public function index(Request $request)
    {
        $users = User::whereRoleIs('admin')->where(function($q) use($request){
            return $q->when($request->search,function($query) use($request){
                return $query->where('first_name','like','%' .$request->search.'%')
                ->orWhere('last_name','like','%' .$request->search.'%');
            });
        })->latest()->paginate(10);      
        // if($request->search){
        //     dd($request->all());
        // }
        return view('dashboard.users.index',compact('users'));
        
    }

 
    public function create()
    {
        $users = User::all();
        return view('dashboard.users.create',compact('users'));
    }

    public function store(ValidatorRequest $request)
    {
        $filePath = "users/default.png";
        if ($request->has('image')) {
                $filePath = $this->uploadImage('users',$request->image);
        }
        $request_data = $request->all();
        $request_data['password'] = bcrypt($request->password);
        $request_data['password_confirmation'] = bcrypt($request->password_confirmation);
        $request_data['image'] = $filePath;
       

        // dd($request->all());
        
        $user = User::create($request_data);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

        return redirect()->route('dashboard.users.index')->with('success',__('site.added_successfully'));
    }


   
    public function edit($id)
    {
        $users = User::find($id);
        return view('dashboard.users.edit',compact('users'));
    }


    public function update(UpdateDataValidation $request,$id)
    {
        
         $users = User::find($id);
        $request_data = $request->except(['_token','password','password_confirmation','permissions']);
        if($request->image){
            if($users->image != 'default.png'){
    
                 $path = Public_path($users->image);
                 if(File::exists($path)){
                     File::delete($path);
                 }               
             }
         
             $filePath = "";
             if ($request->has('image')) {
                     $filePath = $this->uploadImage('users',$request->image);
             }
             $request_data['image'] = $filePath;
    
         }
        $request_data['password'] = bcrypt($request->password);
        $request_data['password_confirmation'] = bcrypt($request->password_confirmation);


        $users->update($request_data);
  
        $users->syncPermissions($request->permissions);
        return redirect()->route('dashboard.users.index')->with('success',__('site.updated_successfully'));

    }


    public function destroy(User $user)
    {
        if($user->image != 'default.png'){
       // if($user->firstOrFail()){
            
        $path = Public_path($user->image);
        if(File::exists($path)){
            File::delete($path);
        }
        //}
    }

           $user->delete();
                return redirect()->route('dashboard.users.index')->with('success',__('site.deleted_successfully'));
               
    }
}
