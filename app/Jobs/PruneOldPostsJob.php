<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PruneOldPostsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new PruneOldPostsJob())->dailyAt('00:00');
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $twoYearsAgo = Carbon::now()->subYears(2);
        Post::where('created_at', '<', $twoYearsAgo)->delete();

    }
    public function deleteOldPosts(Request $request)
    {
        // Dispatch the job
        dispatch(new PruneOldPostsJob());

        // Optionally, you can provide feedback to the user
        return response()->json(['message' => 'Old posts deletion has been initiated']);
    }

}
