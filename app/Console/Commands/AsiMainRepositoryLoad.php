<?php

namespace App\Console\Commands;

use App\Repositories\Interfaces\AsiMainRepositoryInterface;
use Illuminate\Console\Command;

/**
 * ASI - Fetches data from remote API and stores to database
 */
class AsiMainRepositoryLoad extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asi:load:main';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches data from Main ASI Api and populates data to models';

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
     * @return int
     */
    public function handle(AsiMainRepositoryInterface $repository)
    {
        $this->newLine();
        $this->line('Fetching Data from remote API');

        /* Courses */
        $this->comment('Courses');
        $this->withProgressBar($repository->courses(), function($course) {
           sleep(1);
        });
        $this->newLine();

        /* Topics */
        $this->comment('Topics');
        $this->withProgressBar($repository->topics(), function($topic) {
            sleep(1);
        });
        $this->newLine();


        /* Taxonomy */
        $this->comment('Taxonomy');
        $this->withProgressBar($repository->taxonomy(), function($taxonomy) {
            sleep(1);
        });
        $this->newLine();

        $this->info('Task Complete');
        return Command::SUCCESS;
    }

}
