<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;

class BlogController extends Controller
{
    public function getSingle($slug){

        //首先可以用一個簡單的return $slug做為測試;
        //return $slug;
        
        //fetch from the BD based on slug
        
       $post = Post::where('slug','=',$slug)->first();
        //return $post;
        
        //return the view and pass in the post object
        return view('blog.single')->withPost($post);

    }
}
