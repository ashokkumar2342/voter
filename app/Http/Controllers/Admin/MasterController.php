<?php

namespace App\Http\Controllers\Admin;

use App\Helper\MyFuncs;
use App\Http\Controllers\Controller;
use App\Model\Assembly;
use App\Model\AssemblyPart;
use App\Model\BlockMc;
use App\Model\BlocksMc;
use App\Model\District;
use App\Model\State;
use App\Model\Village;
use App\Model\WardVillage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PDF;

class MasterController extends Controller
{
   public function index()
   { 
     try {
          $States= State::orderBy('name_e','ASC')->get();   
          return view('admin.master.states.index',compact('States'));
        } catch (Exception $e) {
            
        }
     
   }
   public function store(Request $request,$id=null)
   {  
       $rules=[
            'code' => 'required|unique:states,code,'.$id, 
            'name_english' => 'required', 
            'name_local_language' => 'required', 
            // 'syllabus' => 'required', 
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
       $States= State::firstOrNew(['id'=>$id]);
       $States->code=$request->code;
       $States->name_e=$request->name_english;
       $States->name_l=$request->name_local_language; 
       $States->save();
       $response=['status'=>1,'msg'=>'Submit Successfully'];
       return response()->json($response);
      }
    }
    public function edit($id)
     { 
       try {  
            $States= State::find($id);   
            return view('admin.master.states.edit',compact('States'));
          } catch (Exception $e) {
              
          }
       
     }


//-------districts--------------districts--------------districts---------------districts----//



   public function districts(Request $request)
   {
      try {
          $Districts= District::orderBy('name_e','ASC')->get();   
          $States= State::orderBy('name_e','ASC')->get();   
          return view('admin.master.districts.index',compact('Districts','States'));
        } catch (Exception $e) {
            
        }
   }
   public function districtsStore(Request $request,$id=null)
   {  
       $rules=[
            'states' => 'required', 
            'code' => 'required|unique:districts,code,'.$id, 
            'name_english' => 'required', 
            'name_local_language' => 'required', 
            // 'syllabus' => 'required', 
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
       $States= District::firstOrNew(['id'=>$id]);
       $States->state_id=$request->states;
       $States->code=$request->code;
       $States->name_e=$request->name_english;
       $States->name_l=$request->name_local_language; 
       $States->save();
       $response=['status'=>1,'msg'=>'Submit Successfully'];
       return response()->json($response);
      }
    }
    public function districtsEdit($id)
    {
       try {
          $Districts= District::find($id);
          $States= State::orderBy('name_e','ASC')->get();   
          return view('admin.master.districts.edit',compact('Districts','States'));
        } catch (Exception $e) {
            
        }
    }
    
   
     
    //------------block-mcs----------------------------//

    public function BlockMCS(Request $request)
   {
      try {
          $Districts= District::orderBy('name_e','ASC')->get();   
          $States= State::orderBy('name_e','ASC')->get();   
          $BlocksMcs= BlocksMc::orderBy('name_e','ASC')->get();   
          return view('admin.master.block.index',compact('Districts','States','BlocksMcs'));
        } catch (Exception $e) {
            
        }
   }
   public function BlockMCSStore(Request $request,$id=null)
   {  
       $rules=[
            'states' => 'required', 
            'district' => 'required', 
            'code' => 'required|unique:blocks_mcs,code,'.$id, 
            'name_english' => 'required', 
            'name_local_language' => 'required', 
            // 'syllabus' => 'required', 
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
       $States= BlocksMc::firstOrNew(['id'=>$id]);
       $States->states_id=$request->states;
       $States->districts_id=$request->district;
       $States->code=$request->code;
       $States->name_e=$request->name_english;
       $States->name_l=$request->name_local_language; 
       $States->save();
       $response=['status'=>1,'msg'=>'Submit Successfully'];
       return response()->json($response);
      }
    }
    public function BlockMCSEdit($id)
    {
       try {
          $Districts= District::orderBy('name_e','ASC')->get();   
          $States= State::orderBy('name_e','ASC')->get();   
          $BlocksMcs= BlocksMc::find($id);  
          return view('admin.master.block.edit',compact('Districts','States','BlocksMcs'));
        } catch (Exception $e) {
            
        }
    }

    //
    //------------village----------------------------//

    public function village(Request $request)
   {
      try {
          $Districts= District::orderBy('name_e','ASC')->get();   
          $States= State::orderBy('name_e','ASC')->get();   
          $BlocksMcs= BlocksMc::orderBy('name_e','ASC')->get();   
          $Villages= Village::orderBy('name_e','ASC')->get();   
          return view('admin.master.village.index',compact('Districts','States','BlocksMcs','Villages'));
        } catch (Exception $e) {
            
        }
   }
   public function villageStore(Request $request,$id=null)
   {  
       $rules=[
            'states' => 'required', 
            'district' => 'required', 
            'block_mcs' => 'required', 
            'code' => 'required|unique:villages,code,'.$id, 
            'name_english' => 'required', 
            'name_local_language' => 'required', 
            // 'syllabus' => 'required', 
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
       $States= Village::firstOrNew(['id'=>$id]);
       $States->states_id=$request->states;
       $States->districts_id=$request->district;
       $States->blocks_id=$request->block_mcs;
       $States->code=$request->code;
       $States->name_e=$request->name_english;
       $States->name_l=$request->name_local_language; 
       $States->draft_processed=0; 
       $States->final_processed=0; 
       $States->print_prepared=0; 
       $States->is_locked=0; 
       $States->save();
       $response=['status'=>1,'msg'=>'Submit prepared'];
       return response()->json($response);
      }
    }
    public function villageEdit($id)
    {
       try {
        
          $Districts= District::orderBy('name_e','ASC')->get();   
          $States= State::orderBy('name_e','ASC')->get();   
          $BlocksMcs= BlocksMc::find($id);  
          return view('admin.master.block.edit',compact('Districts','States','BlocksMcs'));
        } catch (Exception $e) {
            
        }
    } 
     //------------ward-village----------------------------//

    public function ward(Request $request)
   {
      try {
          $Districts= District::orderBy('name_e','ASC')->get();   
          $States= State::orderBy('name_e','ASC')->get();   
          $BlocksMcs= BlocksMc::orderBy('name_e','ASC')->get();   
          $Villages= Village::orderBy('name_e','ASC')->get();
          $wards= WardVillage::orderBy('ward_no','ASC')->get();    
          return view('admin.master.wards.index',compact('Districts','States','BlocksMcs','Villages','wards'));
        } catch (Exception $e) {
            
        }
   }
   public function wardStore(Request $request,$id=null)
   {  
       $rules=[
            'states' => 'required', 
            'district' => 'required', 
            'block_mcs' => 'required', 
            'village' => 'required', 
            
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
        DB::select(DB::raw("call up_create_village_ward ('$request->village','$request->ward','0')"));

        
       $response=['status'=>1,'msg'=>'Submit prepared'];
       return response()->json($response);
      }
    }
    //------------Assembly----------------------------//

    public function Assembly(Request $request)
   {
      try {
          $Districts= District::orderBy('name_e','ASC')->get();  
          $assemblys= Assembly::orderBy('name_e','ASC')->get();   
          return view('admin.master.assembly.index',compact('Districts','assemblys'));
        } catch (Exception $e) {
            
        }
   }
   public function AssemblyStore(Request $request,$id=null)
   {   
       $rules=[
            
            'district' => 'required', 
            'code' => 'required|unique:assemblys,code,'.$id, 
            'name_english' => 'required', 
            'name_local_language' => 'required', 
            // 'syllabus' => 'required', 
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
       $States= Assembly::firstOrNew(['id'=>$id]); 
       $States->district_id=$request->district; 
       $States->code=$request->code;
       $States->name_e=$request->name_english;
       $States->name_l=$request->name_local_language; 
       $States->save();
       $response=['status'=>1,'msg'=>'Submit Successfully'];
       return response()->json($response);
      }
    }
    public function AssemblyEdit($id)
    {
       try {
          $Districts= District::orderBy('name_e','ASC')->get();  
          $assembly= Assembly::find($id);  
          return view('admin.master.assembly.edit',compact('Districts','States','assembly'));
        } catch (Exception $e) {
            
        }
    }


    //------------AssemblyPart----------------------------//

    public function AssemblyPart(Request $request)
   {
      try {
          $assemblys= Assembly::orderBy('name_e','ASC')->get();  
          $assemblyParts= AssemblyPart::orderBy('part_no','ASC')->get();   
          return view('admin.master.assemblypart.index',compact('assemblyParts','assemblys'));
        } catch (Exception $e) {
            
        }
   }
   public function AssemblyPartStore(Request $request,$id=null)
   {   
       $rules=[
            
            'Assembly' => 'required', 
            'part_no' => 'required|unique:assemblys,code,'.$id, 
           
            
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
       $States= AssemblyPart::firstOrNew(['id'=>$id]); 
       $States->assembly_id=$request->Assembly; 
       $States->part_no=$request->part_no; 
       $States->village_id=0; 
       $States->import_date=0; 
       $States->save();
       $response=['status'=>1,'msg'=>'Submit Successfully'];
       return response()->json($response);
      }
    }
    public function AssemblyPartEdit($id)
    {
       try {
          $Districts= District::orderBy('name_e','ASC')->get();  
          $assembly= Assembly::find($id);  
          return view('admin.master.assembly.edit',compact('Districts','States','assembly'));
        } catch (Exception $e) {
            
        }
    }

    //-----MappingVillageAssemblyPart-----------------
    public function MappingVillageAssemblyPart()
    {
       try {
          $Districts= District::orderBy('name_e','ASC')->get();   
          $States= State::orderBy('name_e','ASC')->get();   
          $BlocksMcs= BlocksMc::orderBy('name_e','ASC')->get();   
          $Villages= Village::orderBy('name_e','ASC')->get();  
          return view('admin.master.mappingvillageassemblypart.index',compact('Districts','States','Villages','BlocksMcs'));
        } catch (Exception $e) {
            
        }
    }
    public function MappingVillageAssemblyPartFilter(Request $request)
    {
       try {
          $assemblys= Assembly::orderBy('name_e','ASC')->get();  
          $Parts= AssemblyPart::orderBy('part_no','ASC')->get();  
          $assemblyParts= AssemblyPart::where('village_id',$request->id)->get();   
             
          return view('admin.master.mappingvillageassemblypart.value',compact('assemblys','Parts','assemblyParts','OldParts'));
        } catch (Exception $e) {
            
        }
    }
    public function MappingAssemblyWisePartNo(Request $request)
    { 
       $Parts= AssemblyPart::where('assembly_id',$request->id)->get();
       $OldParts= AssemblyPart::where('village_id',$request->village_id)->pluck('id')->toArray();
       return view('admin.master.assemblypart.part_no_select_box',compact('Parts','OldParts'));  
    }
    public function MappingVillageAssemblyPartStore(Request $request)
    {
        $rules=[
             
            'village' => 'required', 
            'assembly' => 'required', 
            'part_no' => 'required', 
             
            
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
          $assemblyPart=AssemblyPart::where('assembly_id',$request->assembly)->where('id',$request->part_no)->first();
          $assemblyPart->village_id=$request->village; 
          $assemblyPart->save();
        
       $response=['status'=>1,'msg'=>'Submit Successfully'];
       return response()->json($response);
      }
    }
    public function MappingVillageAssemblyPartRemove($assemblyPart_id)
     {
          $assemblyPart=AssemblyPart::find($assemblyPart_id);
          $assemblyPart->village_id=0; 
          $assemblyPart->save();
        
          $response=['status'=>1,'msg'=>'Remove Successfully'];
          return response()->json($response);
     } 
  //------------ward-bandi----------WardBandi-------//
    public function WardBandi()
    {
       try {
          $Districts= District::orderBy('name_e','ASC')->get();   
          $States= State::orderBy('name_e','ASC')->get();   
          $BlocksMcs= BlocksMc::orderBy('name_e','ASC')->get();   
          $Villages= Village::orderBy('name_e','ASC')->get();  
          return view('admin.master.wardbandi.index',compact('Districts','States','Villages','BlocksMcs'));
        } catch (Exception $e) {
            
        }
    }
    public function WardBandiFilter(Request $request)
    {
       try{ 
          $assemblyParts= AssemblyPart::where('village_id',$request->id)->get();   
          $WardVillages= WardVillage::where('village_id',$request->id)->get();   
          return view('admin.master.wardbandi.value',compact('assemblyParts','WardVillages'));
        } catch (Exception $e) {
            
        }
    }
    public function WardBandiFilterAssemblyPart(Request $request)
    {
       try{ 
           $voterLists=DB::select(DB::raw("select `v`.`sr_no`, `v`.`name_l`, `v`.`father_name_l`, `vil`.`name_l` as `vil_name`, `wv`.`ward_no`from `voters` `v`Left Join `villages` `vil` on `vil`.`id` = `v`.`village_id`Left Join `ward_villages` `wv` on `wv`.`id` = `v`.`ward_id`Where `v`.`assembly_part_id` =$request->id;"));  
          return view('admin.master.wardbandi.voter_list',compact('voterLists'));
        } catch (Exception $e) {
            
        }
    } 
    public function WardBandiFilterward(Request $request)
    {
       try{ 
          $total_mapped=DB::select(DB::raw("select count(*) as `total_mapped` from `voters` where `ward_id` = $request->id;"));   
          return view('admin.master.wardbandi.sr_no_form',compact('total_mapped'));
        } catch (Exception $e) {
            
        }
    }
    public function WardBandiStore(Request $request)
   {  
       $rules=[
            'states' => 'required', 
            'district' => 'required', 
            'block_mcs' => 'required', 
            'village' => 'required', 
            'assembly_part' => 'required', 
            'from_sr_no' => 'required', 
            'to_sr_no' => 'required', 
            
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
        if ($request->forcefully==1) {
         $forcefully=1; 
        }else{
         $forcefully=0; 
        }

         DB::select(DB::raw("call up_ward_bandi_voters ('$request->assembly_part','$request->ward','$request->from_sr_no','$request->to_sr_no','$forcefully')"));
        
        
       $response=['status'=>1,'msg'=>'Submit Successfully'];
       return response()->json($response);
      }
    } 

    



    //---------onchange---------onchange-----------onchange---------------onchange-----------onchange

    public function stateWiseDistrict(Request $request)
    {
       try{ 
          $Districts=District::where('state_id',$request->id)->get();   
          return view('admin.master.districts.value_select_box',compact('Districts'));
        } catch (Exception $e) {
            
        }
    }
    public function DistrictWiseBlock(Request $request)
    {
       try{ 
          $BlocksMcs=BlocksMc::where('districts_id',$request->id)->get();   
          return view('admin.master.block.value_select_box',compact('BlocksMcs'));
        } catch (Exception $e) {
            
        }
    }
    public function BlockWiseVillage(Request $request)
    {
       try{ 
          $Villages=Village::where('blocks_id',$request->id)->get();   
          return view('admin.master.village.value_select_box',compact('Villages'));
        } catch (Exception $e) {
            
        }
    }
    
}
