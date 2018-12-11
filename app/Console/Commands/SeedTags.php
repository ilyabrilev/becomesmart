<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SeedTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tags:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $tagPrefix = 'tag';

        $tagArrayToAdd = [];
        for ($i = 0; $i < 10; $i++) {
            $tagArrayToAdd[] = [
                'tag'   => $tagPrefix . $i
            ];
        }

        \DB::table('glossary_tags')
            ->insert($tagArrayToAdd);
    }
}
