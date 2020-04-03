<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Resources\Contact as ResourcesContact;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(){

        $data = request()->validate([
            'q' => 'required'
        ]);

        $contacts = Contact::search($data['q'])
            ->where('user_id', request()->user()->id)
            ->take(6)
            ->get();
        return ResourcesContact::collection($contacts);
    }
}
