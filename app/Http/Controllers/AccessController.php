<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AccessController extends Controller
{
    /**
     * Contructor to control access to the application
     *
     */
    function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Home directory is called to redirect signed in users to directories
     *  Or redirect guests to log-in page
     */
    public function home(){
        if(auth()->check()){
            if($this->isAdmin()){
                return redirect('/admin');
            }
            else{
                return redirect('/student');
            }
        }
        else{
            redirect('/');
        }
    }

    /**
     * Helper function for the home() method
     * Does the actual check and re-direction
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    private function isAdmin(){
        if(auth()->user()->role == 1) {
            return true;
        }
        else{
            return false;
        }
    }
}
