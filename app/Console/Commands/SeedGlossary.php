<?php

namespace App\Console\Commands;

use App\GlossaryWord;
use App\User;
use Illuminate\Console\Command;
use PHPHtmlParser\Dom;

class SeedGlossary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'glossary:seed';

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

    public function handle()
    {
        $site = 'http://smogue.com/glossary/';
        $pagesArr = [
            'a', 'b', 'v', 'g', 'd', 'ye', 'zh', 'z', 'i', 'k', 'l', 'm', 'n', 'o', 'p',
            'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'e', 'yu', 'ya'
        ];
        $suffix = '.php';

        $client = new \GuzzleHttp\Client();
        foreach ($pagesArr as $page) {
            $this->comment("Requesting page $page");
            $url = $site . $page . $suffix;
            $res = $client->request('GET', $url, []);
            $dom = new Dom();
            $body = $dom->load($res->getBody());
            $main = $body->getElementById('main');
            $divs = $dom->load($main->innerHtml())->getElementsByTag('div');
            $foundIt = $divs[1];
            //$this->comment($foundIt->innerHtml());
            $this->ParseWordSection($foundIt);
            //return;
        }

        $this->comment('Done');
    }

    private function ParseWordSection(string $section) {
        $linkForMoreUrlStart = 'https://ru.wiktionary.org/wiki/';

        $lines = explode('<br />', $section);

        $arrayToAdd = [];
        foreach ($lines as $l) {
            if (!$l) {
                continue;
            }
            $l = trim($l);

            if ((!preg_match('/<span class="orange">([^<>\/"]+)<\/span>/', $l, $wordMatches)) || (\count($wordMatches) < 2)) {
                $this->ReportParsingError($l);
                continue;
            }
            $word = $wordMatches[1];

            if ((!preg_match('/<\/span>([^<>]+)/', $l, $definitionMatches)) || (\count($definitionMatches) < 2)) {
                $this->ReportParsingError($l);
                continue;
            }
            $definition = ltrim($definitionMatches[1], ' –');
            //преобразование первой буквы в верхний регистр, поскольку ucfirst некорректно работает с UTF-8
            $definition = mb_strtoupper(mb_substr($definition, 0, 1), 'utf-8') . mb_substr($definition, 1, mb_strlen($definition), 'utf-8');

            $linkForMore = $linkForMoreUrlStart . mb_strtolower($word);

            $arrayToAdd[] = [
                'word'          => $word,
                'definition'    => $definition,
                'link_for_more' => $linkForMore
            ];
        }

        $this->comment('Found ' . \count($arrayToAdd) . ' words. Inserting...');
        \DB::table('glossary_words')
            ->insert($arrayToAdd);
        $this->comment('Inserted');
    }

    private function ReportParsingError($l) {
        $this->comment("Error while trying to parse string '$l'");
    }
}
