<?php

namespace App\Console\Commands;

use App\Models\GlossaryTag;
use App\Models\GlossaryWord;
use Illuminate\Console\Command;

class AddTagsToWords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'glossary:tagstowords';

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
     * @throws \Exception
     */
    public function handle()
    {
        $allWords = GlossaryWord::all();
        $allTags = GlossaryTag::all();

        $arrayToInsert = [];

        $count = \count($allWords);
        $i = 0;

        foreach ($allWords as $word) {
            foreach ($allTags as $tag) {
                $random = \random_int(1, 10);

                if ($random === 1) {
                    $arrayToInsert[] = [
                        'glossary_tag_id'   => $tag['id'],
                        'glossary_word_id'  => $word['id']
                    ];
                }
            }
            $i++;
            $this->comment("Done $i out of $count");
        }

        \DB::table('glossary_tag_glossary_word')
            ->insert($arrayToInsert);

        $insertedCount = \count($arrayToInsert);
        $this->comment("Inserted $insertedCount");
    }
}
