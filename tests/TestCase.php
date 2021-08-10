<?php

namespace Tests;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use \Illuminate\Support\Facades\Hash;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    public function setUp(): void
    {



        parent::setUp();


        $user = User::updateOrCreate([
            'name' => 'Demo User',
            'email'=>'demo@demo.com',
            'password' => Hash::make('password'),
            'phone' => '0000000000'
        ]);

        $data = [
            'name' => 'Base Test Category',
            'description' => 'Unit Testing Categories'];
        $category = Category::create($data);

    }
}
