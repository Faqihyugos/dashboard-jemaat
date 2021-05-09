<?php

namespace App\Http\Controllers;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class JemaatController extends Controller
{ /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
       $data = DB::table('jemaats')->get();
       return view('jemaat.index', compact('data'));
   }

   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
        return view("jemaat.create");
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {

        $validation = \Validator::make($request->all(),[
            "name" => "required|min:4|max:100",
            "gender" => "required",
            "status" => "required",
            "phone" => "required|digits_between:10,12",
            "placeofbirth" => "required|min:4",
            "dateofbirth" => "required",
            "avatar" => "mimes:jpg,png,jpeg",
        ])->validate();

        $age = Carbon::parse($request->get('dateofbirth'))->age;
        // dd($age);
        $kat = "";
        if ($age <= 12){
            $kat = "PA GPIB";
        } elseif ($age <= 16) {
            $kat = "PT GPIB";
        } elseif ( ($age <= 35) && ($request->get('status') === 'Belum Kawin') ) {
            $kat = "GP GPIB";
        } elseif ( ($age <= 59) && ($request->get('gender') === 'Laki-laki') ) {
            $kat = "PKP GPIB";
        } elseif (($age <= 59) && ($request->get('gender') === 'Perempuan')) {
            $kat = "PKB GPIB";
        } else {
            $kat = "PKLU GPIB";
        }

       // insert table jemaat
        $jemaat = new \App\Models\Jemaat;
        $jemaat->name = $request->get('name');
        $jemaat->placeofbirth = $request->get('placeofbirth');
        $jemaat->dateofbirth = $request->get('dateofbirth');
        $jemaat->gender = $request->get('gender');
        $jemaat->status = $request->get('status');
        $jemaat->pelkat = $kat;
        $jemaat->address = $request->get('address');
        $jemaat->phone =  $request->get('phone');

        if($request->file('avatar')){
            $file = $request->file('avatar')->store('avatars', 'public');
            $jemaat->avatar = $file;
        }
        $jemaat->save();
        Toastr::success('Data entered successfully :)','Success');
        return view("jemaat.create");
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
        $jemaat = \App\Models\Jemaat::findOrFail($id);
         return view('jemaat.show', ['jemaat' => $jemaat]);
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
        $jemaat = \App\Models\jemaat::findOrFail($id);
        return view('jemaat.edit', ['jemaat' => $jemaat]);
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, $id)
     {

        $validation = \Validator::make($request->all(),[
            "name" => "required|min:4|max:100",
            "gender" => "required",
            "status" => "required",
            "phone" => "required|digits_between:10,12",
            "placeofbirth" => "required|min:4",
            "dateofbirth" => "required",
            "avatar" => "mimes:jpg,png,jpeg",
        ])->validate();

        $age = Carbon::parse($request->get('dateofbirth'))->age ;
        // dd($age);
        $kat = null;
        if ($age <= 12){
            $kat = "PA GPIB";
        } elseif ($age <= 16) {
            $kat = "PT GPIB";
        } elseif ( ($age <= 35) && ($request->get('status') === 'Belum Kawin') ) {
            $kat = "GP GPIB";
        } elseif ( ($age <= 59) && ($request->get('gender') === 'Laki-laki') ) {
            $kat = "PKP GPIB";
        } elseif (($age <= 59) && ($request->get('gender') === 'Perempuan')) {
            $kat = "PKB GPIB";
        } else {
            $kat = "PKLU GPIB";
        }

        // dd($kat);

         // insert table jemaat
        $jemaat = \App\Models\Jemaat::findOrFail($id);
        $jemaat->name = $request->get('name');
        $jemaat->placeofbirth = $request->get('placeofbirth');
        $jemaat->dateofbirth = $request->get('dateofbirth');
        $jemaat->gender = $request->get('gender');
        $jemaat->pelkat = $kat;
        $jemaat->status = $request->get('status');
        $jemaat->address = $request->get('address');
        $jemaat->phone =  $request->get('phone');

        if($request->file('avatar')){
            if($jemaat->avatar && file_exists(storage_path('app/public/' .
                $jemaat->avatar))){
                    \Storage::delete('public/'.$jemaat->avatar);
                }
            $file = $request->file('avatar')->store('avatars', 'public');
            $jemaat->avatar = $file;
        }
        $jemaat->save();

        Toastr::success('Data updated successfully :)','Success');
        return redirect()->route('jemaat.edit', [$id]);

     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
        $data = \App\Models\Jemaat::findOrFail($id);
        $data->delete();
        Toastr::success('Data deleted successfully :)','Success');
        return redirect()->route('jemaat.index');
     }

    public function search(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate   = $request->input('toDate');
        $data = DB::table('jemaats')->select()
        ->where('dateofbirth', '>=', $fromDate)
        ->where('dateofbirth', '<=', $toDate)
        ->get();

    // dd($query);
    return view('jemaat.index',compact('data'));

    }

}
