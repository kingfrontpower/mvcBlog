<?php 
namespace App\Http\Controllers;

class PagesController extends Controller{
    public function getIndex(){
        // process variable data or params
        // talk to the model
        // receive back from the model
        // compile or process data from the model if needed 
        // pass that data to the correct view
        return view('pages.welcome');

    }
    
    public function getAbout(){
        $fullname="王前權";
        $myemail="kingfrontpower@gamil.com";
        $myData=[];
        $myData['fullName']=$fullname;
        $myData["myEmail"]=$myemail;  
        
        //return view('pages.about')->with('mydata',$myData);
        
        return view('pages.about')->withMydata($myData);
    }
    
    public function getContact(){

        return view('pages.contact');

    }
    public function postContact(){

    }

}