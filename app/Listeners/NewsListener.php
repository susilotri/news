<?php

namespace App\Listeners;

use App\Events\NewsEvent;
use App\Models\AcivityLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewsListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewsEvent $event)
    {
        AcivityLog::create([
            'news_id' => $event->data,
            'activity' => $event->activity,
            'user' => $event->user
        ]);
    }
}
