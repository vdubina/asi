<?php

namespace App\Console\Commands;

use App\Repositories\Interfaces\AsiRemoteRepositoryInterface;
use Illuminate\Console\Command;

class AsiRemotePopulate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asi:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ASI - Fetches data from remote API and stores to database';

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
    public function handle(AsiRemoteRepositoryInterface $repository)
    {
        $courses = $repository->courses();
        $this->newLine();
        $this->comment('Processing Courses');
        $this->withProgressBar($courses, function($course) {
           sleep(2);
        });


        $topics = $repository->topics();
        $this->newLine();
        $this->comment('Processing Topics');
        $this->withProgressBar($topics, function($topic) {
            sleep(2);
        });


        $taxonomy = $repository->taxonomy();
        $this->newLine();
        $this->comment('Processing Taxonomy');
        $this->withProgressBar($taxonomy, function($taxonomy) {
            sleep(2);
        });

        $this->newLine();
        $this->info('Task Complete');
        return Command::SUCCESS;
    }

}
