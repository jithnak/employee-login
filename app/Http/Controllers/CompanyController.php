<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Core;
use App\Models\CompanyModel;
use Illuminate\Support\Facades\Validator;
use DataTables,Auth,DB;

class CompanyController extends Controller
{
    //
    public function add_company(Request $request)
     {
     	// return 1;
     	if($request->name!='')
     	{
     		$edit = $request->edit_id;
     	if($edit!='')
     	{
       
     	$file=$request->logo;
     	if($file!='')
     	{
     	$image = getimagesize($file);
        $width = $image[0];
        $height = $image[1];
        if($width==100 && $height==100)
        {	

        $file_name = uniqid().'.'.$file->getClientOriginalExtension();
        $path = base_path().'/public/uploads/company';
        $file->move($path, $file_name);
        $fullpath = $file_name;
       }
       else
       {
       	return redirect('dashboard')->with('error','Logo size must be 100*100');
       }

     	$data = [
     		'company_ip'=>$request->ip(),
     		'company_status'=>0,
     		'company_name'=>$request->name,
     		'company_email'=>$request->email,
     		'company_logo'=>$fullpath,
     		'company_website'=>$request->website,

     		 ];
       $update= DB::table('tbl_company')->where('company_id',$request->edit_id)->update($data);
       if($update)
     {
     	return redirect('dashboard')->with('message','Data Updated Successfully');
     }
     else
     {
     	return redirect('dashboard')->with('error','Something Went Wrong');
     }

     	}
     	else
     	{

     	$data = [
     		'company_ip'=>$request->ip(),
     		'company_status'=>0,
     		'company_name'=>$request->name,
     		'company_email'=>$request->email,
     		'company_website'=>$request->website,

     		 ];

      $update= DB::table('tbl_company')->where('company_id',$request->edit_id)->update($data);
      if($update)
     {
     	return redirect('dashboard')->with('message','Data Updated Successfully');
     }
     else
     {
     	return redirect('dashboard')->with('error','Something Went Wrong');
     }
     	}
       

     	}
     	else
     	{
           $file=$request->logo;
        $image = getimagesize($file);
        $width = $image[0];
        $height = $image[1];
        if($width==100 && $height==100)
        {	

        $file_name = uniqid().'.'.$file->getClientOriginalExtension();
        $path = base_path().'/public/uploads/company';
        $file->move($path, $file_name);
        $fullpath = $file_name;
       }
       else
       {
       	return redirect('dashboard')->with('error','Logo size must be 100*100');
       }

     	$data = [
     		'company_ip'=>$request->ip(),
     		'company_status'=>0,
     		'company_name'=>$request->name,
     		'company_email'=>$request->email,
     		'company_logo'=>$fullpath,
     		'company_website'=>$request->website,

     		 ];
     
        
     $insert = DB::table('tbl_company')->insertGetId($data);

     if($insert)
     {
     	return redirect('dashboard')->with('message','Data added Successfully');
     }
     else
     {
     	return redirect('dashboard')->with('error','Something Went Wrong');
     }
     

     	}
     	
     	}
     	else
     	{
     		return redirect('dashboard')->with('error','Name is required');
     	}	
     	

     	
         

     }
     public function getDataTable(Request $request)
     {
        $id =  $request->id;
       // return $id;
       $data  = DB::table('tbl_company')->select('*')->where('company_id',$id)->first(); 
      return response()->json(['data'=>$data]);
     }
     public function delete(Request $request)
    {
     $data=[
          'company_status'=>1,
          
        ];
    $update= DB::table('tbl_company')->where('company_id',$request->id)->update($data);     
    if($update)
     {
     	return redirect('dashboard')->with('message','Data Deleted Successfully');
     }
     else
     {
     	return redirect('dashboard')->with('error','Something Went Wrong');
     }
}
}
