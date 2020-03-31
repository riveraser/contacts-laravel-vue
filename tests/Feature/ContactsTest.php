<?php

namespace Tests\Feature;

use App\Post;
use App\Contact;
use App\User;
use Carbon\Carbon;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Symfony\Component\HttpFoundation\Response;

class ContactsTest extends TestCase
{
    use  RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    private function data()
    {
        return [
            'name'      => 'Pepe Toro',
            'email'     => 'pepe@toro.com',
            'birthday'  => '12/29/1978',
            'company'   => 'SRivera Corp',
            'api_token' => $this->user->api_token
        ];

    }

    /** @test */
    public function a_list_of_contacts_can_be_fetched_for_the_authenticated_user()
    {
        $userOne = factory(User::class)->create();
        $userTwo = factory(User::class)->create();

        $contactOne = factory(Contact::class)->create(['user_id'=> $userOne->id]);
        $contactTwo = factory(Contact::class)->create(['user_id'=> $userTwo->id]);

        $response = $this->get('/api/contacts?api_token=' . $userOne->api_token);

       //dd( json_decode($response->getContent() ) );

        $response
            ->assertJsonCount(1)
            ->assertJson( [
                'data' =>[
                    [
                        'data' => [
                            'contact_id'    => $contactOne->id,
                            'name'          => $contactOne->name,
                            'email'         => $contactOne->email,
                            'birthday'      => $contactOne->birthday->format("m/d/Y"),
                            'company'       => $contactOne->company,
                            'last_update'   => $contactOne->updated_at->diffForHumans()
                        ],
                        'links' => [
                            'self'=> $contactOne->path()
                        ]
                     ]
                ]
            ]);
    }


    /** @test */
    public function an_unauthenticated_user_must_be_redirected_to_login()
    {
        $response = $this->post('/api/contacts', array_merge ( $this->data(), ['api_token'=>''] ) );
        $response->assertRedirect('/login');
        $this->assertCount(0, Contact::all());
    }

    /** @test */
    public function an_authenticated_user_can_add_a_contact()
    {
        //$this->withoutExceptionHandling();

        $reponse = $this->post('/api/contacts', $this->data());

        //dd( json_decode( $reponse->getContent() ) );
        $contact = Contact::first();

        //$this->assertCount(1, $contact );
        $this->assertEquals( $this->data()['name'] ,      $contact->name);
        $this->assertEquals( $this->data()['email'],      $contact->email);
        $this->assertEquals( $this->data()['birthday'],   $contact->birthday->format('m/d/Y'));
        $this->assertEquals( $this->data()['company'],    $contact->company);

        $reponse
            ->assertStatus( Response::HTTP_CREATED )
            ->assertJson([
                'data' => [
                    'contact_id' => $contact->id
                ],
                'links' => [
                    'self'=> $contact->path()
                ]
            ]);

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
        $contact = factory(Contact::class)->create(['user_id'=> $this->user->id ] );

        $response = $this->get( '/api/contacts/' . $contact->id . '?api_token=' . $this->user->api_token );


        $response->assertJson([
            'data'=> [
                'contact_id'    => $contact->id,
                'name'          => $contact->name,
                'email'         => $contact->email,
                'birthday'      => $contact->birthday->format("m/d/Y"),
                'company'       => $contact->company,
                'last_update'   => $contact->updated_at->diffForHumans()
            ]
        ]);
    }

    /** @test */
    public function only_the_users_contacts_can_be_retrieved()
    {
        $contact = factory(Contact::class)->create(['user_id'=> $this->user->id ] );
        $testUser = factory(User::class)->create();

        $response = $this->get( '/api/contacts/' . $contact->id . '?api_token=' . $testUser->api_token );

        $response->assertStatus(403);

    }


    /** @test */
    public function a_contact_can_be_updated()
    {
       $this->withoutExceptionHandling();

        $contact = factory(Contact::class)->create(['user_id' => $this->user->id ] );

        $response = $this->put('/api/contacts/' .  $contact->id, $this->data());

        $contact = $contact->fresh();

        $this->assertEquals( $this->data()['name'] ,      $contact->name);
        $this->assertEquals( $this->data()['email'],      $contact->email);
        $this->assertEquals( $this->data()['birthday'],   $contact->birthday->format('m/d/Y') );
        $this->assertEquals( $this->data()['company'],    $contact->company);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'data' => [
                    'contact_id' => $contact->id
                ],
                'links' => [
                    'self'=> $contact->path()
                ]
            ]);

    }

    /** @test */
    public function only_the_owner_can_updated_the_contact()
    {
        //$this->withoutExceptionHandling();

        $contact = factory(Contact::class)->create(['user_id'=> $this->user->id ] );

        $testUser = factory(User::class)->create();

        $response = $this->put('/api/contacts/' .  $contact->id,
            array_merge ($this->data(), ['api_token' => $testUser->api_token])) ;

        $response->assertStatus(403);

    }

    /** @test */
    public function a_contact_can_be_deleted()
    {
        //$this->withoutExceptionHandling();

        $contact = factory(Contact::class)->create(['user_id' => $this->user->id] );

        $response = $this->delete('/api/contacts/' . $contact->id ,
            ['api_token'=> $this->user->api_token]
        );

        $this->assertCount(0, Contact::all());

        $response
            ->assertStatus(Response::HTTP_NO_CONTENT);


    }

    /** @test */
    public function only_the_owner_can_delete_the_contact()
    {

       // $this->withoutExceptionHandling();

        $contact = factory(Contact::class)->create();

        $testUser = factory(User::class)->create();

        $response = $this->delete('/api/contacts/' . $contact->id ,
            ['api_token'=> $this->user->api_token]
        );

        $response->assertStatus(403);
    }

}

