<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\Job;
use Database\Factories\JobFactory;

class JobTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan("db:seed");
    }

    /**
     * Test create a job
     *
     * @return void
     */
    public function testCreateJob()
    {
        $this->json('POST', '/job', ['reference' => 'uuid', 'name' => 'test', 'description' => 'description', "schedule_at" => "2021-09-20 12:00"])
            ->seeStatusCode(201);
    }

    /**
     * Test update job
     *
     * @return void
     */
    public function testUpdateJob()
    {
        $jobDefinitions = JobFactory::factoryForModel(Job::class)->definition();
        $this->json('PUT', '/job/' . $jobDefinitions['reference'], ['name' => 'test', 'description' => "test"])
            ->seeStatusCode(200);
    }
    /**
     * Test remove job
     *
     * @return void
     */
    public function testRemoveJob()
    {
        $jobDefinitions = JobFactory::factoryForModel(Job::class)->definition();
        $this->json('Delete', '/job/' . $jobDefinitions['reference'])
            ->seeStatusCode(204);
    }
    /**
     * Test get job by reference
     *
     * @return void
     */
    public function testGetJobByReference()
    {
        $jobDefinitions = JobFactory::factoryForModel(Job::class)->definition();
        $this->json('GET', '/job/' . $jobDefinitions['reference'])
            ->seeStatusCode(200);
    }
}
