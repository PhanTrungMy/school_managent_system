<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\SchoolSubject;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function ViewDesignation(){
        $data['allData'] = Designation::all();
        return view('backend.setup.designation.view_designation',$data);
    }
    public function AddDesignation(){
        return view('backend.setup.designation.add_designation');
    }
    public function StoreDesignation(Request $request){
        $validatedData = $request->validate([
            'name' =>'required|unique:designations,name',

        ]);
        $data = new Designation();
        $data->name = $request->name;
        $data->save();
        $notification =  array(
            'message' =>'Designation  Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('designation.view')->with($notification);
    }
    public function DesignationEdit($id){
        $editData = Designation::find($id);
        return view('backend.setup.designation.edit_designation',compact('editData'));

    }
    public function DesignationUpdate(Request $request,$id)
    {

        $data = Designation::find($id);
        $validatedData = $request->validate([
            'name' =>'required|unique:designations,name',
        ]);

        $data->name = $request->name;
        $data->save();
        $notification =  array(
            'message' =>'Designation Update Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('designation.view')->with($notification);
    }
    public function DesignationDelete($id){
        $data = Designation::find($id);

        $data->delete();
        $notification =  array(
            'message' =>'Designation Delete Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('designation.view')->with($notification);

    }
}
