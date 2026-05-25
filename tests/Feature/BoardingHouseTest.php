<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\BoardingHouse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BoardingHouseTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_add_boarding_house_with_rating(): void
    {
        $admin = \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $city = new City();
        $city->name = 'Manila';
        $city->region = 'NCR';
        $city->save();

        $response = $this->actingAs($admin)->post(route('boarding-houses.store'), [
            'city_id' => $city->id,
            'name' => 'Sunrise Boarding House',
            'description' => 'A cozy place to stay',
            'location' => '123 Taft Ave',
            'room_type' => 'single',
            'total_beds' => 5,
            'available_beds' => 3,
            'size_sqm' => 15.5,
            'price_per_month' => 3500,
            'is_available' => 1,
            'rating' => 4,
        ]);

        $response->assertRedirect('/listings');
        $this->assertDatabaseHas('boarding_houses', [
            'name' => 'Sunrise Boarding House',
            'rating' => 4,
        ]);
    }

    public function test_guests_cannot_add_boarding_house(): void
    {
        $city = new City();
        $city->name = 'Manila';
        $city->region = 'NCR';
        $city->save();

        $response = $this->post(route('boarding-houses.store'), [
            'city_id' => $city->id,
            'name' => 'Sunrise Boarding House',
            'description' => 'A cozy place to stay',
            'location' => '123 Taft Ave',
            'room_type' => 'single',
            'total_beds' => 5,
            'available_beds' => 3,
            'size_sqm' => 15.5,
            'price_per_month' => 3500,
            'is_available' => 1,
            'rating' => 4,
        ]);

        $response->assertRedirect('/login');
    }

    public function test_regular_users_cannot_add_boarding_house(): void
    {
        $user = \App\Models\User::create([
            'name' => 'Regular User',
            'email' => 'user@test.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $city = new City();
        $city->name = 'Manila';
        $city->region = 'NCR';
        $city->save();

        $response = $this->actingAs($user)->post(route('boarding-houses.store'), [
            'city_id' => $city->id,
            'name' => 'Sunrise Boarding House',
            'description' => 'A cozy place to stay',
            'location' => '123 Taft Ave',
            'room_type' => 'single',
            'total_beds' => 5,
            'available_beds' => 3,
            'size_sqm' => 15.5,
            'price_per_month' => 3500,
            'is_available' => 1,
            'rating' => 4,
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHas('error', 'Access denied. Admin privileges required.');
    }

    public function test_can_update_boarding_house_with_rating(): void
    {
        $admin = \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $city = new City();
        $city->name = 'Manila';
        $city->region = 'NCR';
        $city->save();

        $house = new BoardingHouse();
        $house->city_id = $city->id;
        $house->name = 'Sunrise Boarding House';
        $house->description = 'A cozy place to stay';
        $house->location = '123 Taft Ave';
        $house->room_type = 'single';
        $house->total_beds = 5;
        $house->available_beds = 3;
        $house->size_sqm = 15.5;
        $house->price_per_month = 3500;
        $house->is_available = 1;
        $house->rating = 4;
        $house->save();

        $response = $this->actingAs($admin)->put(route('boarding-houses.update', $house->id), [
            'city_id' => $city->id,
            'name' => 'Sunset Boarding House',
            'description' => 'An updated description',
            'location' => '456 Taft Ave',
            'room_type' => 'shared',
            'total_beds' => 6,
            'available_beds' => 4,
            'size_sqm' => 18,
            'price_per_month' => 4000,
            'is_available' => 1,
            'rating' => 5,
        ]);

        $response->assertRedirect('/listings');
        $this->assertDatabaseHas('boarding_houses', [
            'id' => $house->id,
            'name' => 'Sunset Boarding House',
            'rating' => 5,
        ]);
    }

    public function test_can_search_boarding_houses(): void
    {
        $city1 = new City();
        $city1->name = 'Manila';
        $city1->region = 'NCR';
        $city1->save();

        $city2 = new City();
        $city2->name = 'Cebu';
        $city2->region = 'Region VII';
        $city2->save();

        // House 1: Manila, single room, ₱3500
        $house1 = new BoardingHouse();
        $house1->city_id = $city1->id;
        $house1->name = 'Manila Single';
        $house1->location = '123 Taft Ave';
        $house1->room_type = 'single';
        $house1->total_beds = 5;
        $house1->available_beds = 3;
        $house1->price_per_month = 3500;
        $house1->is_available = 1;
        $house1->rating = 4;
        $house1->save();

        // House 2: Cebu, shared room, ₱5000
        $house2 = new BoardingHouse();
        $house2->city_id = $city2->id;
        $house2->name = 'Cebu Shared';
        $house2->location = '456 Cebu St';
        $house2->room_type = 'shared';
        $house2->total_beds = 6;
        $house2->available_beds = 4;
        $house2->price_per_month = 5000;
        $house2->is_available = 1;
        $house2->rating = 5;
        $house2->save();

        // Search for Cebu, shared, max budget 6000
        $response = $this->get('/listings?city_id=' . $city2->id . '&room_type=shared&budget=6000');
        $response->assertStatus(200);
        $response->assertSee('Cebu Shared');
        $response->assertDontSee('Manila Single');
    }
}
