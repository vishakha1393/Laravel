<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Session;

use Auth;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $user = '';
       $templateValues = array('user' => $user, 'title' => 'User Page');
       if(Auth::check()) {
         $client = new \GuzzleHttp\Client();
         $res = $client->request('GET', 'https://api.coinmarketcap.com/v2/ticker/1/');

         $response = $res->getBody();
         if(!empty($response)) {
            $jsonValue = json_decode($response, true);
            $usdPrice = $jsonValue['data']['quotes']['USD']['price'];
            $templateValues['price'] = $usdPrice;
         }
       }

       return view('user.index', $templateValues);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function register()
   {
       return view('user.register', array('title' => 'Register'));
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
      $this->validate($request, array(
                             'name' => 'required|max:255',
                             'email' => 'required|email|max:255|unique:users',
                             'password' => 'required|min:6|confirmed',
                         )
                     );

     //$input = $request->all();
     //dd($request->email);
     //dd($input); // dd() helper function is print_r alternative

     User::create(array(
                     'name' => $request->name,
                     'email' => $request->email,
                     'password' => bcrypt($request->password),
                 ));

     Session::flash('flash_message', 'User registration successful!');

     //return redirect()->back();
     //return redirect('user');
     return redirect()->route('user.login');
    }

    /**
     * Show the login form
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('user.login', array('title' => 'Login'));
    }

    /**
     * Authenticate user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        if (Auth::attempt(array('email' => $request->email, 'password' => $request->password))) {
            return redirect()->route('user.index');
        } else {
            return redirect()->route('user.login');
        }
    }

    /**
     * Logout user
     *
     * @return \Illuminate\Http\Response
     */
    public function logout() {
        Auth::logout();
        return redirect()->route('user.login');
    }

    /**
     * Show the login form
     *
     * @return \Illuminate\Http\Response
     */
    public function account()
    {
        return view('user.account', array('title' => 'My Account'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
