<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;



use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (!Auth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid email or password'], 401);
            }

            $user = Auth::user();

            return response()->json(['user' => $user]);

        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function register(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
                'fullname' => 'required',
                'idno' => 'required',
                'usertype' => 'required|in:0,1',
            ]);

            if($validator->fails()){
                throw new ValidationException($validator);
            }

            $user = User::create([
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'name' => $request->input('fullname'),
                'idno' => $request->input('idno'),
                'role' => $request->input('usertype'),
            ]);
            return response()->json(['user' => $user], 201);

        }catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email,'.$id,
                'fullname' => 'required',
                'idno' => 'required',
                'usertype' => 'required|in:0,1',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $user = User::findOrFail($id);

            $user->email = $request->input('email');
            $user->name = $request->input('fullname');
            $user->idno = $request->input('idno');
            $user->role = $request->input('usertype');

            $user->save();

            return response()->json(['user' => $user], 200);

        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['message' => 'User deleted successfully'], 200);

        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function allUsers()
    {
        try {
            $users = User::select('id', 'idno', 'email', 'role', 'name as fullname')->where('role','!=', '1')->get();

            return response()->json($users, 200);

        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
