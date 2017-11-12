<?php

use Illuminate\Database\Seeder;
use App\Models\Coc\Skillsets\Skillset;

use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;

class CocSkillsetsTableSeeder extends Seeder
{
    const PATH = '/database/seeds/seed/CocSkillsetSeed.csv';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config = new LexerConfig();
        $config->setDelimiter(',');
        $lexer = new Lexer($config);
        $interpreter = new Interpreter();
        $interpreter->addObserver(function(array $row) {
            $record = [
                'name' => array_shift($row),
            ];

            $skillset = Skillset::create($record);
            $skillset->save();
            $skillset->skills()->sync(array_filter($row));
        });

        $lexer->parse(base_path().self::PATH, $interpreter);
    }
}
