<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileGeneratingTest extends TestCase
{
    public function __construct()
    {
        $this->name_attribute = strtolower('test-file123');
        $this->filename       = ucfirst($this->name_attribute) . '.vue';
    }

    public function testFileGenerating()
    {
        // Command execute is successful
        Artisan::call('make:vue-component', ['name' => $this->name_attribute, '--no-interaction' => true]);
        $this->assertEquals(trim(Artisan::output()), 'Component created successfully.');

        // File with the correct name was created
        $this->assertTrue(Storage::disk('vue-components')->exists($this->filename));

    }

    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {
        parent::tearDown();
        Storage::disk('vue-components')->delete($this->filename);
    }
}
