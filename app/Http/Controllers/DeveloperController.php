<?php

namespace App\Http\Controllers;
use App\Models\Developer;



use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Developer::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'first_name'=> 'required|string|max:191',
          'last_name'=>'required|string|max:191',
          'email'=>'required|email',
          'phone_number'=>'required|digits:10',
          'address'=>'required',
          'photo'=> 'required',
        ]);

        $userImage = $request['photo'];
        $userImage = time() . '.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
        $img = \Image::make($request->photo);
        $img->save('images/' . $userImage);

        Developer::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'phone_number' => $request['phone_number'],
            'address' => $request['address'],
            'photo' => $userImage,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $request->validate([
            'first_name'=> 'required|string|max:191',
            'last_name'=>'required|string|max:191',
            'email'=>'required|email',
            'phone_number'=>'required|digits:10',
            'address'=>'required',
            'photo'=> 'required',
          ]);

          $user_images = Developer::where('id', '=', $id)->get('photo');
            if ($request['photo'] != $user_images[0]['photo']) {

                if (file_exists('images/' . $user_images[0]['photo'])) {
                    unlink('images/' . $user_images[0]['photo']);
                }
                $userImage = $request['photo'];
        $userImage = time() . '.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
        $img = \Image::make($request->photo);
        $img->save('images/' . $userImage);
                Developer::where('id', '=', $id)
                    ->update([
                        'photo' => $userImage,
                    ]);
            }
            Developer::where('id',$id)->update([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'email' => $request['email'],
                'phone_number' => $request['phone_number'],
                'address' => $request['address'],
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $developer  = Developer::findOrFail($id);
        $developer->delete();

        return ['message' => 'developer Deleted'];
    }

    public function multiDeleteDeveloper(Request $request)
    {
        try{
            Developer::whereIn('id',$request['id'])->delete();
            return ["message"=> 'Selected Developer Deleted'];
        }
        catch(Exception $e)
        {
            return ["message"=> 'Not Developer Deleted'];
        }
    }
}
