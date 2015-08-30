<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class AccessController extends Controller
{
    /**
     * Constructor to control access to the application
     */
    function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Home directory is called to redirect signed in users to directories
     * Or redirect guests to log-in page
     */
    public function home(){
        if(auth()->check()){
            return $this->isAdmin() ? redirect('/admin') : redirect('/student');
        }
        else{
            redirect('/');
        }
    }

    /**
     * Helper function for the home() method
     * Does the actual check and re-direction
     * @return bool
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
