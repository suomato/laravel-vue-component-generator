<?php

namespace Suomato\VueComponentGenerator\Commands;

use Illuminate\Console\Command;
use Storage;

class GenerateVueComponent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:vue-component {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Vue component';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name     = strtolower($this->argument('name'));
        $filename = ucfirst($name) . '.vue';

        // If Vue component already exists
        if (Storage::disk('vue-components')->exists($filename)) {
            $this->error('Component already exists!');

            return 0;
        }

        // Choose template engine and CSS Pre-processor
        $template = config('vue-component-generator.template') ?? strtolower($this->choice('Choose template engine',
                ['HTML', 'Pug'], 0));
        $style    = config('vue-component-generator.style') ?? strtolower($this->choice('Choose CSS Pre-processor',
                ['CSS', 'LESS', 'Sass', 'Scss', 'Stylus'], 0));

        // Create Vue Component file
        Storage::disk('vue-components')->put($filename,
            view('laravel-vue-component-generator::vue-component', compact('name', 'style', 'template'))
        );

        $this->info('Component created successfully.');
    }
}
