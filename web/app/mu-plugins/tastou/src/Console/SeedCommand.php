<?php

namespace Tastou\Console;

use Roots\Acorn\Console\Commands\Command;

class SeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tastou:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the database.';

    public function handle()
    {
        $entity = $this->choice(
            'What is your name?',
            [
                '\\Tastou\\Database\\Seeders\\HtmlFormsSeeder' => 'HTML Forms',
            ]
        );

        $this->call('db:seed', ['--class' => $entity]);
    }
}
