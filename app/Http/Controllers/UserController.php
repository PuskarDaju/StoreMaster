<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    public function logout(){
        return redirect()->route('login');
    }

    public function dashboard(){
        $users=User::all();
        return view('user.index',compact('users'));
    }

    public function showCreateUserForm(){

        return view("user.create_user_form");

    }

    public function storeUser(Request $request){
   
        $validated = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'password' => 'required|string|min:6|confirmed',
        ]); 

        if ($validated->fails()) {
            return redirect()->back()
                ->withErrors($validated) // 🟢 Pass validation errors to session
                ->withInput();           // 🟢 Keep old input data
        }



    // ✅ Create new user
        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']); // Secure hash
        
        // Optional: Assign default role & status
        $user->role = 'user';
        $user->status = 'active';
        
        $user->save();
        
        // ✅ Redirect back with success message
        return redirect()->route('user.dashboard')->with('success', 'User created successfully.');
    }

      public function showEditUserForm($id){
        $user=User::findOrFail($id);
        return view('user.edit_user_form',compact('user'));
        
    }
    public function update(Request $request,User $user){
    // ✅ Validate input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => [
            'required',
            'email',
            'max:255',
            Rule::unique('users')->ignore($user->id), // allows keeping same email
        ],
        'role' => 'required|in:admin,user',
    ]);
   

    // ✅ Update user fields
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->role = $validated['role'];
    $user->save();

    // ✅ Redirect with success message
    return redirect()->route('user.dashboard')->with('success', 'User updated successfully.');
}
public function changePasswordForm($id){
    $user=User::findOrFail($id);
    return view('user.change_password',compact('user'));
}

public function updatePassword(Request $request, User $user){
    $validator=Validator::make($request->all(),[
        'password' => 'required|string|min:6|confirmed',
    ]);
    if($validator->fails()){
        return redirect()->back()->withErrors("password and confirm password do not match");
    }
    $user=User::findOrFail($user->id);
    $user->password=Hash::make($request->password);
    $user->save();

    return redirect()->route('user.dashboard')->with('success',"password updated successfully");
}

public function userActivateOrDeactivate(User $user)
{
    // Prevent user from deactivating themselves
    if (Auth::id() == $user->id) {
        return redirect()->back()->withErrors("You cannot deactivate yourself.");
    }

    if ($user->status === 'active') {
        $user->status = 'inactive';
        $msg = $user->name . " deactivated successfully.";
    } else {
        $user->status = 'active';
        $msg = $user->name . " activated successfully.";
    }

    $user->save();

    return redirect()->route('user.dashboard')->with('success', $msg);
}




    
}
