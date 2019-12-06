<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;
use App\Subjects;
use App\Messages;

class ForumController extends Controller
{
    public function newsubject(Request $request) {
        $categories = Categories::select('name')->get();
        return view('newsubject')
            ->with('categories', $categories)
            ->with('login', $request->session()->get('user_id'))
            ->with('error_message', $request->session()->get('error_message') ?? null);
    }

    public function categories(Request $request)
    {
        $categories = Categories::all();
        return view('categories')
            ->with('categories', $categories)
            ->with('login', $request->session()->get('user_id'))
            ->with('error_message', $request->session()->get('error_message') ?? null);
    }

    public function category(Request $request, $catName)
    {
        $subjects = Subjects::where('category', $catName)->get();
        return view('subjects')
            ->with('category', $catName)
            ->with('subjects', $subjects)
            ->with('login', $request->session()->get('user_id'))
            ->with('error_message', $request->session()->get('error_message') ?? null);
    }

    public function createsubject(Request $request) {
        // On vérifie qu'on a bien reçu les données en POST
        if ( !$request->has(['name','category','content']) )
            return redirect('forum/category')->with('error_message','Some POST data are missing.');

        $subject = new Subjects;
        $subject->name = $request->input('name');
        $subject->category = $request->input('category');
        $subject->authorID = $request->session()->get('user_id');
        $subject->content = $request->input('content');

        try {
            $subject->save();
        }
        catch (\Illuminate\Database\QueryException $e) {
                return redirect('forum/newsubject')->with('error_message','Le nom d\'article existe deja!');
        }

        return redirect('forum/categories');
    }

    public function subject(Request $request, $catName, $idSubject) {
        $subject = Subjects::where('id', $idSubject)->first();
        $messages = Messages::where('subject', $idSubject)->get();
        return view('subject')
            ->with('subject', $subject)
            ->with('messages', $messages)
            ->with('category', $catName)
            ->with('login', $request->session()->get('user_id'))
            ->with('error_message', $request->session()->get('error_message') ?? null);
    }

    public function sendmessage(Request $request, $catName, $idSubject) {

        // On vérifie qu'on a bien reçu les données en POST
        if ( !$request->has(['content']) )
            return redirect('subject')->with('error_message','Some POST data are missing.');

        $message = new Message;
        $message->subject = $idSubject;
        $message->contents = $request->input('content');
        $message->authorID = $request->session()->get('user_id');
        $message->publicationDate = now();

        try {
            $message->save();
        }
        catch (\Illuminate\Database\QueryException $e) {
            return redirect('home')->with('error_message','Le nom d\'article existe deja!');
        }

        return redirect('home');
    }
}
