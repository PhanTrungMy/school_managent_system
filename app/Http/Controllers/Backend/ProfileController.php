<?php /** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function ProfileView()
    {
//        $data['allData'] = User::all();
            $id = Auth::user()->id;
            $user = User::find($id);
            return view('backend.user.view_profile',compact('user'));

    }
        public function ProfileEdit(){
            $id = Auth::user()->id;
            $editData = User::find($id);
            return view('backend/user/edit_profile',compact('editData'));
        }













}