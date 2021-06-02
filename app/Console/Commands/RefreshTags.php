<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RefreshTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:tags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove tags that does not have associated record in blog_tag.';

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
    public function handle()
    {
        DB::table('tags')
                    ->leftJoin('blog_tag', function ($join) {
                        $join->on('tags.id', '=', 'blog_tag.tag_id')
                            ->where('blog_tag.tag_id', null);
                    })
                    ->delete();

        $this->info('Successfully deleted unassociated tags.');
    }
}
