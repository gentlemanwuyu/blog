<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use App\Events\Track;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Modules\Backend\Models\ArticleData;

class IncrementListener
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
     * @param  Track  $event
     * @return void
     */
    public function handle(Track $event)
    {
        try {
            if (!empty($event->visitor->article_id)) {
                $article_data = ArticleData::where('article_id', $event->visitor->article_id)->first();
                if (!$article_data) {
                    ArticleData::create([
                        'article_id' => $event->visitor->article_id,
                        'views' => 1,
                    ]);
                }else {
                    $article_data->views++;
                    $article_data->save();
                }
            }
        }catch (\Exception $e) {
            Log::error("[IncrementListener Exception][" . get_class($e) . "]" . $e->getMessage());
        }
    }
}
