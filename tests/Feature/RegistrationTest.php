<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest2 extends TestCase
{
   
    /** @test */
    public function a_teacher_can_register(){
        $response = $this->postJson('/register', [
            'fullname'=> "John Doe",
            'username'=> 'johndoe',
            'email'=> 'johndoe@email.com',
            'password'=>'super-secret',
            'password_confirmation'=>'super-secret',
            'class' => 'beacon',
            'gender' => 'M',
            'phone' => '+23567694',
        ]);

        $response->assertStatus(status:302);
        $response->assertRedirect("/home");

        $user = User::first();
        $teacher = Teacher::first();

        $this->assertNotNull(($user));
        $this->assertNotNull(($teacher));

        $this->assertEquals('beacon', $teacher->class);
        $this->assertEquals('beacon', $user->class);
    }
}
