<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{

    private function validateData()
    {   
        //Validations
        return request()->validate([
            'name'      => 'required',
            'email'     => 'required|email', 
            'birthday'  => 'required',
            'company'   => 'required'
        ]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Contact::class);

        return  request()->user()->contacts;
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Contact::class);

        request()->user()->contacts()->create($this->validateData());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contacts
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //Need to check if the user can view contacts
        $this->authorize('view', $contact);

        return $contact::first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contacts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        
        $this->authorize('update', $contact);

        $contact->update($this->validateData());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contacts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $this->authorize('delete', $contact);
        
        $contact->delete();
    }
}
