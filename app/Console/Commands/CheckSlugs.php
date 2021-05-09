<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;

class CheckSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $articles = Article::where('slug', null)->get();
        foreach ($articles as $article) {
            $originalTitle = $article->title;
            $article->title = "fdfd";
            $article->save();
            $article->title = $originalTitle;
            $article->save();
            $this->info("Updated slug: " . $article->slug);
        }
    }
}
