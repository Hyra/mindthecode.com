<?php

use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Route;
use Spatie\SchemaOrg\Schema;
use Spatie\Sheets\Sheets;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Sheets $sheets) {
    $articles = $sheets->collection('posts')->all()->take(3)->reverse();
    return view('home', ['articles' => $articles]);
});

Route::get('/blog', function (Sheets $sheets) {
    $articles = $sheets->collection('posts')->all()->reverse();
    return view('blog', ['articles' => $articles]);
});

Route::get('/archive', function (Sheets $sheets) {
    $articles = $sheets->collection('posts')->all()->reverse();
    return view('archive', ['articles' => $articles]);
});

Route::get('/blog/{slug}', function (string $slug, Sheets $sheets) {

    $article = $sheets->collection('posts')->all()->first(function ($item) use ($slug) {
        return $item->slug === $slug;
    });

    if (!$article) {
        $redirect = $sheets->collection('posts')->all()->first(function ($item) use ($slug) {
            if (isset($item->aliases)) {
                if (in_array($slug, $item->aliases)) {
                    return $item->slug;
                }
            }
        });
        if ($redirect) {
            return redirect('/blog/' . $redirect->slug);
        }
    }

    $author = Schema::person()
        ->name('Stef van den Ham')
        ->image('https://mindthecode.com/avatar.jpg');

    $blogArticleData = Schema::blogPosting();
    $blogArticleData->mainEntityOfPage("https://mindthecode.com/");
    $blogArticleData->headline($article->title);
    $blogArticleData->description($article->description);
    $blogArticleData->image('https://mindthecode.com/' . $article->image);
    $blogArticleData->url('https://mindthecode.com/' . $slug);
    $blogArticleData->editor('Stef van den Ham');
    $blogArticleData->publisher($author);
    // $blogArticleData->datePublished($article->published_at);
    // $blogArticleData->dateCreated($article->created_at);
    // $blogArticleData->dateModified($article->updated_at);
    $blogArticleData->datePublished(\Carbon\Carbon::parse($article->date));
    $blogArticleData->dateCreated(\Carbon\Carbon::parse($article->date));
    $blogArticleData->dateModified(\Carbon\Carbon::parse($article->date));
    $blogArticleData->articleBody($article->contents);
    $blogArticleData->author($author);

    // Reent articles
    $recentArticles = $sheets->collection('posts')->all();
    $recentArticles = collect($recentArticles)->reverse()->take(3);

    // Random articles
    $randomArticles = $sheets->collection('posts')->all();
    $randomArticles = collect($randomArticles)->random(3);

    return view('article', ['article' => $article, 'blogArticleData' => $blogArticleData, 'randomArticles' => $randomArticles, 'recentArticles' => $recentArticles]);
})->name('articles.show');

Route::get('/setup', function () {
    $content = Markdown::parse(implode('', file(resource_path('content/setup.md'))));
    return view('setup', ['content' => $content]);
});

Route::get('/contact', function () {
    $content = Markdown::parse(implode('', file(resource_path('content/contact.md'))));
    return view('contact', ['content' => $content]);
});

Route::feeds();
