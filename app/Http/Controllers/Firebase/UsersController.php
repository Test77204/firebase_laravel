<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Kreait\Firebase\Contract\Database;


class UsersController extends Controller
{
    private $database, $tablename;

    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'users';
    }

    public function index () {
        $users = $this->database->getReference($this->tablename)->getValue();

        return view('firebase.users.index', compact('users'));
    }

    public function create () {
        return view('firebase.users.create');
    }

    public function store (Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'mobile' => ['required', 'numeric', 'digits:10'],
            'address' => 'required',
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->passes()) {
            $user_data = [
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'password' => Hash::make($request->password),
            ];
            $postRef = $this->database->getReference($this->tablename)->push($user_data);

            if ($postRef){
                return response()->json([
                    'status' => true,
                    'message' => 'User add Successfully!',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong!',
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }
}
