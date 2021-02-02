<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_mocking_external_source()
    {
        Cache::shouldReceive('get')
            ->once()
            ->with('user_cache_time')
            ->andReturn(null);

        Cache::shouldReceive('set')
            ->once()
            ->with('user_cache_time', true, 60);


        Http::fake([
            'http://jsonplaceholder.typicode.com/users' => Http::response($this->fakeUsersResponse(), 200, []),
        ]);

        $response = $this->getJson('/api/v1/users');

        $response->assertStatus(200);

        $structure = [
            [
                'id',
                'name',
                'username',
                'email',
                'email_verified_at',
                'created_at',
                'updated_at'
            ]
        ];
        $response->assertJsonStructure($structure);
    }

    private function fakeUsersResponse(): array
    {
        $response = '[{
            "id": 1,
            "name": "Leanne Graham",
            "username": "Bret",
            "email": "Sincere@april.biz",
            "address": {
              "street": "Kulas Light",
              "suite": "Apt. 556",
              "city": "Gwenborough",
              "zipcode": "92998-3874",
              "geo": {
                "lat": "-37.3159",
                "lng": "81.1496"
              }
            },
            "phone": "1-770-736-8031 x56442",
            "website": "hildegard.org",
            "company": {
              "name": "Romaguera-Crona",
              "catchPhrase": "Multi-layered client-server neural-net",
              "bs": "harness real-time e-markets"
            }
          },
          {
            "id": 2,
            "name": "Ervin Howell",
            "username": "Antonette",
            "email": "Shanna@melissa.tv",
            "address": {
              "street": "Victor Plains",
              "suite": "Suite 879",
              "city": "Wisokyburgh",
              "zipcode": "90566-7771",
              "geo": {
                "lat": "-43.9509",
                "lng": "-34.4618"
              }
            },
            "phone": "010-692-6593 x09125",
            "website": "anastasia.net",
            "company": {
              "name": "Deckow-Crist",
              "catchPhrase": "Proactive didactic contingency",
              "bs": "synergize scalable supply-chains"
            }
          }]';

        return json_decode($response, true);
    }
}
