<?php
namespace App\Http\Controllers\Admin;
use App\Admin;
use App\Events\SmsEvent;
use App\Http\Controllers\Controller; 
use App\Model\AssemblyPart; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class DatabaseConnectionController extends Controller
{
    
    public function DatabaseConnection()
    {
        try {     return 'd';
            return view('admin.DatabaseConnection.form');    
        } catch (Exception $e) {
           return $e; 
        }
       
    }
    public function ConnectionStore(Request $request)
    {
        try {   
              // $data=['hostname'=>$request->ip,'database'=>$request->database,'username'=>$request->user_name,'password'=>$request->password];

            $ipinfoAPI="http://localhost:8001/api/datastore/".$request->ip.'/'.$request->database.'/'.$request->user_name.'/'.$request->password;
            $json =file_get_contents($ipinfoAPI);
            $data= (array) json_decode($json);
           $response=['status'=>1,'msg'=>'Connection Successfully'];
          return response()->json($response);
        } catch (Exception $e) {
           return $e; 
        } 
    }
    public function getTable()
    {
       $ipinfoAPI="http://localhost:8001/api/gettable";
       $json =file_get_contents($ipinfoAPI);
       $datas= (array) json_decode($json);
 
       
       return view('admin.DatabaseConnection.table',compact('datas')); 
             
    }

    public function tableRecordStore(Request $request)
    {   
      $ipinfoAPI="http://localhost:8001/api/getdata/".$request->tables; 
       $json =file_get_contents($ipinfoAPI);
       $datas= (array) json_decode($json);
       foreach ($datas as $key => $value) {
       $AssemblyPart=new AssemblyPart();
       $AssemblyPart->village_id=$value->village_id;
       $AssemblyPart->assembly_id=$value->assembly_id;
       $AssemblyPart->part_no=$value->part_no;
       $AssemblyPart->import_date=$value->import_date;
       $AssemblyPart->save(); 
       }
      $response=['status'=>1,'msg'=>'Transfer Successfully'];
          return response()->json($response);
    } 
       
    
        
}
