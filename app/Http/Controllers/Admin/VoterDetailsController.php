<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Assembly;
use App\Model\AssemblyPart;
use App\Model\BlocksMc;
use App\Model\District;
use App\Model\Gender;
use App\Model\State;
use App\Model\UserActivity;
use App\Model\Village;
use App\Model\Voter;
use App\Model\VoterImage;
use App\Model\WardVillage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Imagick;
class VoterDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 

      $genders= Gender::all();  
      $Districts= District::orderBy('name_e','ASC')->get();  
      return view('admin.voterDetails.index',compact('Districts','genders'));   
    }

    public function districtWiseAssembly(Request $request)
    {
       $assemblys=Assembly::where('district_id',$request->id)->orderBy('code','ASC')->get(); 
       return view('admin.master.assembly.assembly_value_select_box',compact('assemblys'));
    }
    public function districtWiseVillage(Request $request)
    {
       $villages=Village::where('districts_id',$request->id)->orderBy('code','ASC')->get();
       return view('admin.voterDetails.village_value',compact('villages'));
    }
    public function AssemblyWisePartNo(Request $request)
    {
       $Parts= AssemblyPart::where('assembly_id',$request->id)->orderBy('part_no','ASC')->get();  
       return view('admin.voterDetails.select_part_no',compact('Parts')); 
    }
    public function VillageWiseWard(Request $request)
    {
     
      $WardVillages= WardVillage::where('village_id',$request->id)->get(['id','ward_no']);
      return view('admin.voterDetails.select_ward_no',compact('WardVillages')); 
    }
    public function calculateAge(Request $request)
     { 
        $date1=date_create($request->id);
        $date2=date_create(date('Y-m-d'));
        $diff=date_diff($date1,$date2);
        return view('admin.voterDetails.age_value',compact('diff')); 
     } 
    public function store(Request $request)
    { 
        $rules=[
            
            'district' => 'required', 
      ];

      $validator = Validator::make($request->all(),$rules);
      if ($validator->fails()) {
          $errors = $validator->errors()->all();
          $response=array();
          $response["status"]=0;
          $response["msg"]=$errors[0];
          return response()->json($response);// response as json
      }
      else {
            $file =$request->image;
            $imagedata = file_get_contents($file);
            $base64 = base64_encode($imagedata);
            $voter=new Voter(); 
            $voter->district_id = $request->district;
            $voter->assembly_id = $request->assembly;
            $voter->village_id = $request->village;
            $voter->assembly_part_id = $request->part_no;
            $voter->ward_id = $request->ward_no;
            $voter->voter_card_no = $request->voter_id_no;
            $voter->mobile_no = $request->mobile_no;
            $voter->house_no = $request->house_no;
            $voter->house_no_e = $request->house_no;
            $voter->house_no_l = $request->house_no;
            $voter->name_e = $request->voter_name;
            $voter->name_l = $request->voter_name;
            $voter->father_name_e = $request->father_name;
            $voter->relation = $request->relation;
            $voter->gender_id = $request->gender;
            $voter->save();
            $voterimage =new VoterImage();  
            $voterimage->voter_id = $voter->id;  
            $voterimage->image = $base64;  
            $voterimage->save();  
            $response=['status'=>1,'msg'=>'Submit Successfully'];
            return response()->json($response);
      }
     

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\UserActivity  $userActivity
     * @return \Illuminate\Http\Response
     */
    public function show(UserActivity $userActivity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\UserActivity  $userActivity
     * @return \Illuminate\Http\Response
     */
    public function edit(UserActivity $userActivity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\UserActivity  $userActivity
     * @return \Illuminate\Http\Response
     */
    public function DeteleAndRestore()
    {
       
      return view('admin.DeteleAndRestore.index',compact('Districts','genders','voters')); 
    }
    public function DeteleAndRestoreForm()
    {
      $genders= Gender::all();  
      $Districts= District::orderBy('name_e','ASC')->get(); 
      $voterNews=Voter::orderBy('id','DESC')->first(); 
      $voterDeletes=Voter::where('status',1)->get(); 
      return view('admin.DeteleAndRestore.form',compact('Districts','genders','voterNews','voterDeletes')); 
    } 
    public function DeteleAndRestoreSearch()
    {
      return view('admin.DeteleAndRestore.search_model');    
    }
    public function DeteleAndRestoreSearchFilter(Request $request)
    {
      $voters=Voter::where('name_e', 'like','%'.$request->id.'%')->orWhere('voter_card_no', 'like','%'.$request->id.'%')->orWhere('house_no', 'like','%'.$request->id.'%')->get(); 
      return view('admin.DeteleAndRestore.search_table',compact('voters'));    
    }
}
