<?php

namespace Tests\Feature;

use App\Post;
use App\Contact;
use Carbon\Carbon;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ContactsTest extends TestCase
{
    use  RefreshDatabase;

    private function data()
    {
        return [
            'name'      => 'Pepe Toro',
            'email'     => 'pepe@toro.com',
            'birthday'  => '12/29/1978',
            'company'   => 'SRivera Corp'
        ];

    }

    /** @test */
    public function a_contact_can_be_added()
    {
        
        $this->post('/api/contacts', $this->data());

        $contact = Contact::first();
        
        //$this->assertCount(1, $contact );
        $this->assertEquals( $this->data()['name'] ,      $contact->name);
        $this->assertEquals( $this->data()['email'],      $contact->email);
        $this->assertEquals( $this->data()['birthday'],   $contact->birthday->format('m/d/Y'));
        $this->assertEquals( $this->data()['company'],    $contact->company);


    }
    
    /** @test */
    public function fields_are_required(){
        collect( [ 'name', 'email', 'birthday', 'company'])->each(function($field)
        {
            //Remove the passed '$field' to assert the ERROR
            $data = array_merge( $this->data(), [$field=>'']);
                    
            $response = $this->post('/api/contacts', $data);

            $response->assertSessionHasErrors($field);
            $this->assertCount(0, Contact::all());
        });
    }

    /** @test */
    public function email_must_be_a_valid_mail()
    {
         //Modify 'email' 
         $data = array_merge( $this->data(), ['email'=>'pepetoro.invalid.mail']);
                    
         $response = $this->post('/api/contacts', $data);

         $response->assertSessionHasErrors('email');
         $this->assertCount(0, Contact::all());

    }
    
    /** @test */
    public function birthdays_are_stored()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/contacts', $this->data());
        
        $myBirthday = Contact::first()->birthday;

        $this->assertCount(1, Contact::all());
        $this->assertInstanceOf(Carbon::class, $myBirthday);
        $this->assertEquals('29-12-1978', $myBirthday->format('d-m-Y'));
    }

    /** @test */
    public function a_contact_can_be_retrieved()
    {
        $contact = factory(Contact::class)->create();

        $response = $this->get( '/api/contacts/' . $contact->id);
        
        $response->assertJson([
            'name'      => $contact->name,
            'email'     => $contact->email,
            'birthday'  => $contact->birthday,
            'company'   => $contact->company
        ]);
    }

    /** @test */
    public function a_contact_can_be_updated()
    {
       // $this->withoutExceptionHandling();
        
        $contact = factory(Contact::class)->create();

        $response = $this->put('/api/contacts/' .  $contact->id, $this->data());
        
        $contact = $contact->fresh();

        $this->assertEquals( $this->data()['name'] ,      $contact->name);
        $this->assertEquals( $this->data()['email'],      $contact->email);
        $this->assertEquals( $this->data()['birthday'],   $contact->birthday->format('m/d/Y') );
        $this->assertEquals( $this->data()['company'],    $contact->company);

    }

    /** @test */
    public function a_contact_can_be_deleted()
    {
        //$this->withoutExceptionHandling();
        
        $contact = factory(Contact::class)->create();

        $response = $this->delete('/api/contacts/' .  $contact->id, $this->data());
        
        $this->assertCount(0, Contact::all());

    }


}

