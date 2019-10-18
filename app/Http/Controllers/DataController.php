<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DataController extends Controller
{
    public function __construct() {

        $this->middleware('auth');

    }

    public function index() {

      $scan = scandir('/xampp2/htdocs/kapanlagi/storage/app');

      $result = array();

      foreach ($scan as $key => $value) {
        if(strpos($value, '.txt') > 0) {
          $temp = explode(',', file_get_contents('/xampp2/htdocs/kapanlagi/storage/app/'.$value));
          $name_file_ext = $value;
          $name_file = substr($name_file_ext, 0, -4);
          $temp_array = array("name" => $temp[0], "email" => $temp[1], "birthday" => $temp[2], "name_file" => $name_file, "image_path" => $temp[5]);
          array_push($result, $temp_array);
        }
      }

    	return view('data.index', compact('result'));

    }

    public function store(Request $request) {

      $name = $request['name'];
      $email = $request['email'];
      $birthday = $request['birthday'];
      $phone = $request['phone'];
      $gender = $request['gender'];

      $date = date("d");
      $year = date("Y");
      $month = date("m");

      $hour = date("H");
      $minute = date("i");
      $sec = date("s");
      $name_file = $name.'-'.$date.$month.$year.$hour.$minute.$sec;

      if($request['photo'] == NULL) {
        $text = $name.','.$email.','.$birthday.','.$phone.','.$gender.',NULL';
      } else {
        $file = $request->file('photo');
        $fileExtension = $file->getClientOriginalExtension();
        $request->file('photo')->move("image/", 'foto-'.$name_file.'.'.$fileExtension);

        $text = $name.','.$email.','.$birthday.','.$phone.','.$gender.','.'foto-'.$name_file.'.'.$fileExtension;
      }

      Storage::put($name_file.'.txt', $text);

      return redirect()->back()->with('alert', 'Data berhasil dibuat! Terima kasih telah mengisi form');

    }

    public function detail($id) {

      $name_file = $id;

      $result = array();

      $temp = explode(',', file_get_contents('/xampp2/htdocs/kapanlagi/storage/app/'.$id.'.txt'));
      $temp_array = array("name" => $temp[0], "email" => $temp[1], "birthday" => $temp[2], "phone" => $temp[3], "gender" => $temp[4], "name_file" => $temp[5]);
      array_push($result, $temp_array);

      return view('data.detail', compact('name_file', 'result'));

    }

    public function update(Request $request) {
      
      $name = $request['name'];
      $email = $request['email'];
      $birthday = $request['birthday'];
      $phone = $request['phone'];
      $gender = $request['gender'];

      $name_file = $request['id_file'];

      if($request['photo'] == NULL) {
        $text = $name.','.$email.','.$birthday.','.$phone.','.$gender.',NULL';
      } else {
        $file = $request->file('photo');
        $fileExtension = $file->getClientOriginalExtension();
        $request->file('photo')->move("image/", 'foto-'.$name_file.'.'.$fileExtension);

        $text = $name.','.$email.','.$birthday.','.$phone.','.$gender.','.'foto-'.$name_file.'.'.$fileExtension;
      }

      Storage::put($request['id_file'].'.txt', $text);

      return redirect()->back()->with('alert', 'Data berhasil diupdate! Terima kasih');

    }

    public function delete($id) {

      $file_txt = substr($id, 5, -4);
      $file_txt_null = substr($id, 0, -4);

      $cek_name_file = substr($id, -4);

      if($cek_name_file == 'NULL') {
        Storage::delete($file_txt_null.'.txt');
      } else {
        Storage::delete($file_txt.'.txt');

        File::delete('image/' . $id);
      }

      return redirect()->back()->with('alert-danger', 'Data berhasil dihapus!');

    }

}
