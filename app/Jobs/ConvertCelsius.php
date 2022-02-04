<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\PrimeFound;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ConvertCelsius implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $farenheit;
    //public $userId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($farenheit)
    {
        $this->farenheit = $farenheit;
        
        //$this->userId = $userId;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $farenheit = $this->farenheit;
        $celsius = ($farenheit - 32) * 5 / 9;
        logger()->info("Celsius = $celsius");
       
    }
}    
