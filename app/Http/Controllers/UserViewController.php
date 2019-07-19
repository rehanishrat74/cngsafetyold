<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\user;
//use  App\Http\Controllers\Auth;


class UserViewController extends Controller
{
  public function __construct() {
      $this->middleware('auth');
   }
    //
   public function index() {
        //oreach($myModal->getFillable() as $property)
    //echo $this->user->regtype;
    //echo $user->getFillable();
     //echo  Auth::user()->regtype ;

/*$vehicles = DB::table('vehicle_particulars')
            ->leftjoin('owner__particulars','owner__particulars.CNIC','=','vehicle_particulars.OwnerCnic')
              ->joinSub($cng_kit,'cng_kit',function($leftjoin){
                $leftjoin->on('vehicle_particulars.Registration_no','=','cng_kit.VehiclerRegistrationNo');
            })
            ->select('owner__particulars.CNIC','owner__particulars.Owner_name','owner__particulars.CNIC','owner__particulars.Cell_No','owner__particulars.Address', 'vehicle_particulars.Record_no','vehicle_particulars.Registration_no','vehicle_particulars.Chasis_no','vehicle_particulars.Engine_no',
'vehicle_particulars.Vehicle_catid','vehicle_particulars.Make_type','vehicle_particulars.Scan_code','vehicle_particulars.OwnerCnic','vehicle_particulars.businesstype','vehicle_particulars.stationno','cng_kit.VehiclerRegistrationNo','cng_kit.Inspection_Status','cng_kit.formid')
            ->orderby($sortby,'desc')            
            ->paginate(2);*/



if (Auth::user()->regtype =='admin')
{
  $users = DB::table('users')
        ->select('users.*')
        ->where('deleted','!=',1)
        ->paginate(10);

}else if (Auth::user()->regtype =='hdip' || Auth::user()->regtype =='apcng')
{
    $users = DB::table('users')
        ->select('users.*')
        ->where('deleted','!=',1)
        ->where('regtype','=','laboratory')
        ->paginate(10);

}


        //->orderby



      /*$users = DB::select('select * from users');*/
      
      $usertype =Auth::user()->regtype;
      $treeitems =DB::select('select * from AccessRights where regtype =?',[$usertype]);
      //print_r($treeitems);
      return view('user.user_view',['users'=>$users,'treeitems'=>$treeitems])->with('page',1);
   }

   public function HDIPusers()
   {
    $users = DB::table('users')
        ->select('users.*')
        ->where('regtype','=','laboratory')
        ->paginate(10);

      $usertype =Auth::user()->regtype;
      $treeitems =DB::select('select * from AccessRights where regtype =?',[$usertype]);

      return view('user.hdip_labs',['users'=>$users,'treeitems'=>$treeitems])->with('page',1);

   }

  public function AjaxSearch(Request $data) {
 /*$msg = "This is a simple message.";
    $msg = $data->user ;
      return response()->json(array('msg'=> $msg), 200);*/
      $users=DB::table('users')->where('name', 'like', '%'.$data->name.'%')->get();
      //return response()->json(array('msg'=> $msg), 200);
    return response()->json($users, 200);
  }



   public function search(Request $data) {

    $users=DB::table('users')->where('name', 'like', '%'.$data->name.'%')->get();


      $usertype =Auth::user()->regtype;
      $treeitems =DB::select('select * from AccessRights where regtype =?',[$usertype]);

      return view('user.user_view',['users'=>$users,'treeitems'=>$treeitems]);

   }

   public function delete($id)
   {



      $user=DB::select('select email from users where id=?',[$id]) ;
      $email='blocked';
      $email=$email.$user[0]->email;
                              
      
      DB::table('users')
          ->where(['id'=> $id])
          ->update(['deleted' => 1,'email'=>$email ]);                    






 if (Auth::user()->regtype =='admin')
{
  $users = DB::table('users')
        ->select('users.*')
        ->where('deleted','!=',1)
        ->paginate(10);

}else if (Auth::user()->regtype =='hdip')
{
    $users = DB::table('users')
        ->select('users.*')
        ->where('deleted','!=',1)
        ->where('regtype','=','laboratory')
        ->paginate(10);

}
            
      
      $usertype =Auth::user()->regtype;
      $treeitems =DB::select('select * from AccessRights where regtype =?',[$usertype]);
      //print_r($treeitems);
      return view('user.user_view',['users'=>$users,'treeitems'=>$treeitems])->with('page',1);
      

   }
}

            //print_r($users);


            /*$users=DB::table('users')->where('name', 'like', '%'.$data->name.'%')
                                  ->where('category_id', 1)
                                  ->where('city_id', 1)
                                  ->get();*/
                //$users = User::where('name','LIKE',"%{$$data->name}%")->get();
                //echo' data'.$data->name;
                  //$msg = "This is a simple message.";
                 //$querry ='select * from users where name like ';

                 //echo $querry;
                  //$users = DB::select();
                //DB::table('users')->where('name', 'LIKE','%', $data->name,'%')->get();

            /*$term = $data->name;
            $query = User::where('name', 'LIKE', '%' . $term . '%');
            $username=$query->getBindings();
            $querryWithLikeSyntax ='select * from users where name like '.$username[0].'';
            echo $querryWithLikeSyntax;*/
            //$users=dd($query->toSql(), $query->getBindings());
            //$users=$query->toSql();

            //echo 'users:'.$users;
            //print_r($users);
            //echo $users[0];
                  //return view('user.user_view',['users'=>$users]);

                  //return response()->json(array('msg'=> $msg), 200);
                  //return response()->json(array('msg'=> $data), 200);



/*$search = 'hdtopi';

$user = User::where('name','LIKE',"%{$search}%")->get();

print_r($user);


DB::table('job_details')->where('job_title', 'like', '%officer%')
                      ->where('category_id', 1)
                      ->where('city_id', 1)
                      ->get();



$term = '23 test';

$query = User::where('name', 'LIKE', '%' . $term . '%');

*/




