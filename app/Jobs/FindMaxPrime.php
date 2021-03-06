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

class FindMaxPrime implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $limit;
    public $userId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($limit, $userId)
    {
        $this->limit = $limit;
        $this->userId = $userId;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $primo=1;
        for($num=1; $num < $this->limit; $num++){
            for($div=2; $div < $num; $div++){
                if($num % $div == 0){
                    break; //sai do for 2 for apenas
                }
            }
            if ($num == $div){
                $primo = $num;
            }
        }
        $user = User::find($this->userId);
        $user->notify(new PrimeFound
        (
            'Sucesso',
            'O maior Primo até ' . $this->limit. ' é ' . $primo,
        ));
    }
}    
