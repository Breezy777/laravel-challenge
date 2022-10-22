<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Record;
use App\Models\Address;
use Illuminate\Support\Facades\DB;

class BasicController extends Controller
{


    public function index (Record $r){

        // require_once 'View/header.php';

        //$records = new record('','', '');

        $records = $r->getRecords();

        //display a view that receives $brands as parameter
        return view('index', compact('records'));

        // require_once 'View/presentation.php';
    }

    public function save(Request $request){

        // $firstname = $_GET['firstname'] ;
        // $lastname  = $_GET['lastname'] ;
        // $phone  = $_GET['phone'] ;

        $firstname = $request->firstname;
        $lastname  = $request->lastname ;
        $phone  = $request->phone;


        $records = new record($firstname,$lastname,$phone);
        $records->saveRecords();



        return redirect()->action([BasicController::class, 'index']);

    }

    public function remove(Record $records, $id){


        $records->removeRecord($id);



        return redirect()->action([BasicController::class, 'index']);

    }

    public function list_addresses($state=null, $city=null){
      //$addresses = DB::table('addresses')->select(DB::raw("CONCAT(`addresses`.`street_address`,`addresses`.`street_number`) as street_address"), 'street_type', 'zip_code', 'city', 'state')->get()->toJson();

      $base_query = DB::table('addresses')->select(DB::raw("CONCAT(`street_name`, ' ', `street_number`) as street_address"), 'street_type', 'zip_code', 'city', 'state');
      //$addresses = Address::all()->toJson();
      if(!$state && !$city) //list all
      $addresses = $base_query->get()->toJson();
      else if($state && $city)
      $addresses = $base_query->where('state', $state)->orWhere('city', $city)->get()->toJson();
      else if($state)
      $addresses = $base_query->where('state', $state)->get()->toJson();
      else if($city)
      $addresses = $base_query->where('city', $city)->get()->toJson();


      return view('addresses', compact('addresses'));

    }



}
