<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dotenv\Exception\ValidationException;

class SubmitSportsTest extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /** @test */
    function guest_can_submit_a_new_sport() {
        $response = $this->post('/submitSport', [
            'title' => 'Example Title',
            'description' => 'Example description'
        ]);

        $this->assertDatabaseHas('sports',[
            'title' => 'Example Title'
        ]);

        $response
            ->assertStatus(302) // "Found"
            ->assertHeader('Location', url('/'));

        $this
            ->get('/')
            ->assertSee('Example Title');
    }

    /** @test */
    function sport_is_not_created_if_validation_fails(){
        $response = $this->post('/submitSport');
        $response->assertSessionHasErrors(['title']);
    }

    /**
    * @expectsException Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException
    **/
    // helpful link: https://phpunit.de/manual/6.5/en/writing-tests-for-phpunit.html#writing-tests-for-phpunit.exceptions.examples.ExceptionTest.php
    function max_length_fails_when_too_long() {
        $this->withoutExceptionHandling();

        $title = str_repeat('a', 256);
        $description = str_repeat('a', 256);

        try {
            $this->post('/submit', compact('title', 'description'));
        } catch(ValidationException $ex) {
            $this->assertEquals(
                'The title may not be greater than 255 characters.',
                $e->validator->errors()->first('title')
            );
    
            $this->assertEquals(
                'The description may not be greater than 255 characters.',
                $e->validator->errors()->first('description')
            );
    
            return;
        }
        $this->fail('Max length should trigger a ValidationException');
    }

    /** @test */
    function max_length_succeeds_when_under_max() {
        $data = [
            'title' => str_repeat('a', 255),
            'description' => str_repeat('a', 255),
        ];

        $this->post('/submitSport', $data);

        $this->assertDatabaseHas('sports', $data);
    }
}
