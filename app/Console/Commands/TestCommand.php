<?php

namespace App\Console\Commands;

use App\Repayment;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test everything here';

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
        $this->logQuery();

        $repayment = Repayment::with([
            'loan',
            'user' => function ($query) {
                // To prevent Race Condition
                $query->lockForUpdate();
            }])
            ->find(1);
    }

    public function logQuery() {
        \Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
            var_dump($query->sql);
            var_dump($query->bindings);
            var_dump($query->time);
        });
    }
}
