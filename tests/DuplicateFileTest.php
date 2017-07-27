<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DuplicateFileTest extends TestCase
{
    public function __construct()
    {
        $this->name_attribute = strtolower('test-file123');
        $this->filename       = ucfirst($this->name_attribute) . '.vue';
    }

    public function testDuplicateFiles()
    {
        Artisan::call('make:vue-component', ['name' => $this->name_attribute, '--no-interaction' => true]);
        $this->assertEquals(trim(Artisan::output()), 'Component already exists!');

    }

    protected function setUp()
    {
        parent::setUp();
        Storage::disk('vue-components')->put($this->filename, 'content');
    }

    protected function tearDown()
    {
        parent::tearDown();
        Storage::disk('vue-components')->delete($this->filename);
    }
}
