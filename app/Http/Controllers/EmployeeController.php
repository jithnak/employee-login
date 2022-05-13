<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Core;
use App\Models\CompanyModel;
use Illuminate\Support\Facades\Validator;
use DataTables,Auth,DB;

class EmployeeController extends Controller
{
    //
    public function index(Request $request)
     {
        $company  = DB::table('tbl_company')->select('*')->where('company_status',0)->get(); 
        $employee  = DB::table('tbl_employee')->select('tbl_employee.*','tbl_company.company_name')->leftjoin('tbl_company','tbl_company.company_id','=','tbl_employee.employee_company')->where('employee_status',0)->paginate(10); 
        return view('employees',compact('company','employee'));
     }
    public function add_employee(Request $request)
     {
     	
        

     	$data = [
     		'employee_ip'=>$request->ip(),
     		'employee_status'=>0,
     		'employee_first_name'=>$request->first_name,
     		'employee_last_name'=>$request->last_name,
     		'employee_company'=>$request->company,
     		'employee_email'=>$request->email,
            'employee_phone'=>$request->phone,
     		 ];
     
        
     $insert = DB::table('tbl_employee')->insertGetId($data);
     if($insert)
     {
        return redirect('/get-list')->with('message','Data added Successfully');
     }
     else
     {
        return redirect('/get-list')->with('error','Something Went Wrong');
     }
     }
     public function getEmployee(Request $request)
     {
        $id =  $request->id;
       // return $id;
       $data  = DB::table('tbl_employee')->select('tbl_employee.*','tbl_company.company_name')->leftjoin('tbl_company','tbl_company.company_id','=','tbl_employee.employee_company')->where('employee_id',$id)->first(); 
      return response()->json(['data'=>$data]);
     }
      public function update_employee(Request $request)
     {
        
        $data = [
            'employee_ip'=>$request->ip(),
            'employee_status'=>0,
            'employee_first_name'=>$request->first_name,
            'employee_last_name'=>$request->last_name,
            'employee_company'=>$request->company,
            'employee_email'=>$request->email,
            'employee_phone'=>$request->phone,
             ];
     
        
      $update= DB::table('tbl_employee')->where('employee_id',$request->edit_id)->update($data);
      if($update)
     {
        return redirect('/get-list')->with('message','Data updated Successfully');
     }
     else
     {
        return redirect('/get-list')->with('error','Something Went Wrong');
     }
     }
     public function deleteEmployee(Request $request)
    {
     $data=[
          'employee_status'=>1,
          
        ];
    $update= DB::table('tbl_employee')->where('employee_id',$request->id)->update($data);     
   if($update)
     {
        return redirect('/get-list')->with('message','Data deleted Successfully');
     }
     else
     {
        return redirect('/get-list')->with('error','Something Went Wrong');
     }
}
}
