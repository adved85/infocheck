<?php

namespace App\Http\Controllers\Sitemap;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Post;
use App\Question;


class SitemapController extends Controller
{
    public function index() {

        $post = Post::orderBy('updated_at', 'desc')->where('status', '!=', 'unpublished')->first();
        $question = Question::orderBy('updated_at', 'desc')->where('visible',1)->first();


        return response()->view('sitemap.index',[
            'post'=> $post,
            'question'=>$question,
            'siteURL'=> $this->siteURL(),
        ])->header('Content-Type', 'text/xml');
    }


    public function posts() {
        $posts = Post::where('status','<>','unpublished')->with('lang')->get();

        return response()->view('sitemap.posts',[
            'posts' => $posts,
            'siteURL' => $this->siteURL(),
        ])->header('Content-Type', 'text/xml');
    }


    public function questions() {
        $questions = Question::where('visible',1)->with('lang')->get();

        return response()->view('sitemap.questions',[
            'questions' => $questions,
            'siteURL' => $this->siteURL(),
        ])->header('Content-Type', 'text/xml');
    }


    public function siteURL() {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST'].'/';
        return $protocol.$domainName;
    }





}
