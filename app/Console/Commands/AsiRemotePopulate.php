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
        $this->comment(count($repository->courses()).' courses processed');
        $this->comment(count($repository->topics()).' topics processed');
        $this->comment(count($repository->taxonomy()).' taxonomy processed');
        $this->info('Task Complete');
        return Command::SUCCESS;
    }

}
