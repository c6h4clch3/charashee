<?php

use Illuminate\Database\Seeder;
use App\Models\Coc\Skills\Skill;

use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;

class CocSkillsTableSeeder extends Seeder
{
    const PATH = '/database/seeds/seed/CocSkillsSeed.csv';
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
                'name' => $row[0],
                'init' => $row[1],
                'reference' => $row[2] === '' ? null : $row[2],
            ];

            Skill::create($record)->save();
        });

        $lexer->parse(base_path().self::PATH, $interpreter);
    }
}
