<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Record extends Model
{
    use HasFactory;

    private $firstname = '';
    private $lastname = '';
    private $phone = '';
    private $url;

    function __construct($firstname="", $lastname="", $phone=""){
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->phone = $phone;
    }


    public function getRecords(){


        //$url=Storage::url('data.ser');
        //echo $x;
        $url = storage_path("data.ser");

        $records = unserialize( file_get_contents($url) );

        //print_r('<pre>');

       return $records;

    }

    public function saveRecords(){

        $url = storage_path("data.ser");

        $data = unserialize( file_get_contents( $url ) );
        // $i = count((array)$data);
        // echo $i;
        //var_dump($data[1]);
        //unset($data[$i]);
        // $j = count((array)$data);
        // echo $j;
        $data[] = array( 'firstname' => $this->firstname, 'lastname' => $this->lastname, 'phone' => $this->phone );
        //var_dump($data);
        file_put_contents( $url, serialize( $data ) );



    }


    public function removeRecord($id){

        $url = storage_path("data.ser");

        $data = unserialize( file_get_contents( $url ) );


        //var_dump($data[1]);
        unset($data[$id]);

        //$data[] = array( 'firstname' => $this->firstname, 'lastname' => $this->lastname, 'phone' => $this->phone );
        //var_dump($data);
        file_put_contents( $url, serialize( $data ) );

    }

}
