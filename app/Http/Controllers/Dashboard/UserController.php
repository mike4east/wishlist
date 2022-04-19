<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
          public function index(Request $request)
      {
          $users = User::paginate(15);
 
          return view('dashboard.users.index', compact('users'));
      }

      public function destroy(User $user)
      {
          //
      }//
}
