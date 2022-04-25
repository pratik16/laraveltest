<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Forms;
use App\UserForms;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        //$user = User::find(1);
        $forms = Forms::all();
        if ($user->roles->whereIn('id', [1])->count() > 0) {
        
            return view('home', ['fields' => $forms->toArray()]);
        }
        else {
            $userForms = UserForms::where('user_id', $user->id)->first();
            if (!empty($userForms)) {
                $userForms->increment('open');
            }
            else {
                $a = array(
                    'user_id' => $user->id,
                    'open' => 1,
                    'forms' => ''
                );
                UserForms::insert($a);
            }
            
            $f = $user->form;
        
            if (!empty($f) && !empty($f->forms) && $f->count() > 0) {
                return view('guest', ['flag' => 'true']);
            }
            else {
                return view('guest', ['flag' => 'false', 'fields' => $forms->toArray()]);
            }
            
        }
        
    }

    public function users()
    {
        $user = Auth::user();
        //$user = User::find(1);
        $forms = Forms::all();
        if ($user->roles->whereIn('id', [1])->count() > 0) {
            
            $users = User::whereNotIn('id', [1])->with('form')->get();

            return view('users', ['users' => $users->toArray()]);
        }
        
    }

    public function saveadminform (Request $request) {

        $textBox = $request->textbox;
        $property = $request->property;

        if (!empty($textBox) && !empty($property)) {

            $arr = [];
            foreach ($textBox as $key => $text) {
                $arr[] = array(
                    'name' => $text,
                    'properties' => json_encode([$property[$key]])
                );
            }
            Forms::truncate();
            Forms::insert($arr); // Query Builder approach


        }
        return redirect('home');
    }

    public function saveguestform (Request $request) {
        $user = Auth::user();
        $a = $request->all();
        
        unset($a['_token']);
        $formData = json_encode($a);

        $userForms = UserForms::where('user_id', $user->id)->first();
        if (!empty($userForms)) {
            $userForms->forms = $formData;
            $userForms->save();
        }
        else {
            $arr = array(
                'user_id' => $user->id,
                'forms' => $formData
            );
            UserForms::insert($arr);
        }
        
        return redirect('guest');
    }
}
