<?php

use App\Models\Article;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Support\Facades\Route;
use Spatie\SchemaOrg\Schema;

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

Route::get('/', function () {
    // $articles = $sheets->collection('posts')->all()->take(3)->reverse();
    $articles = Article::orderBy('published_at', 'DESC')->take(5)->get();
    return view('home', ['articles' => $articles, 'pageTitle' => 'Mindthecode']);
});

Route::get('/blog', function (int $pageNr = 1) {
    $perPage = 6;

    $articles = Article::orderBy('published_at', 'DESC')->skip(($pageNr - 1) * $perPage)->take($perPage)->get();
    $totalCount = Article::count();

    return view('blog', [
        'articles' => $articles,
        'currentPage' => $pageNr,
        'perPage' => $perPage,
        'totalPages' => $totalCount / $perPage,
        'pageTitle' => 'Blog'
    ]);
});

Route::get('/blog/page/{pageNr?}', function (int $pageNr = 1) {
    $perPage = 6;

    $articles = Article::orderBy('published_at', 'DESC')->skip(($pageNr - 1) * $perPage)->take($perPage)->get();
    $totalCount = Article::count();

    return view('blog', [
        'articles' => $articles,
        'currentPage' => $pageNr,
        'perPage' => $perPage,
        'totalPages' => $totalCount / $perPage,
        'pageTitle' => 'Blog'
    ]);
});

Route::get('/blog/{slug}', function (string $slug) {

    $article = Article::where('slug', $slug)->firstOrFail();

    // $article = $sheets->collection('posts')->all()->first(function ($item) use ($slug) {
    //     return $item->slug === $slug;
    // });

    // if (!$article) {
    //     $redirect = $sheets->collection('posts')->all()->first(function ($item) use ($slug) {
    //         if (isset($item->aliases)) {
    //             if (in_array($slug, $item->aliases)) {
    //                 return $item->slug;
    //             }
    //         }
    //     });
    //     if ($redirect) {
    //         return redirect('/blog/' . $redirect->slug);
    //     }
    // }

    $author = Schema::person()
        ->name('Stef van den Ham')
        ->image('https://mindthecode.com/avatar.jpg');

    $blogArticleData = Schema::blogPosting();
    $blogArticleData->mainEntityOfPage("https://mindthecode.com/");
    $blogArticleData->headline($article->title);
    $blogArticleData->description(Markdown::convertToHtml($article->description));
    $blogArticleData->image('https://mindthecode.com/' . $article->image);
    $blogArticleData->url('https://mindthecode.com/' . $slug);
    $blogArticleData->editor('Stef van den Ham');
    $blogArticleData->publisher($author);
    // $blogArticleData->datePublished($article->published_at);
    // $blogArticleData->dateCreated($article->created_at);
    // $blogArticleData->dateModified($article->updated_at);
    $blogArticleData->datePublished(\Carbon\Carbon::parse($article->published_at));
    $blogArticleData->dateCreated(\Carbon\Carbon::parse($article->published_at));
    $blogArticleData->dateModified(\Carbon\Carbon::parse($article->published_at));
    $blogArticleData->articleBody(Markdown::convertToHtml($article->body_md));
    $blogArticleData->author($author);

    // Random articles
    $randomArticles = Article::inRandomOrder()->take(3)->get();

    return view('article', ['article' => $article, 'blogArticleData' => $blogArticleData, 'randomArticles' => $randomArticles, 'pageTitle' => $article->title]);
})->name('articles.show');

Route::get('/setup', function () {
    $content = implode('', file(resource_path('content/setup.md')));
    return view('setup', ['content' => $content, 'pageTitle' => 'My setup']);
});

Route::get('/contact', function () {
    $content = implode('', file(resource_path('content/contact.md')));
    return view('contact', ['content' => $content, 'pageTitle' => 'Contact']);
});

Route::feeds();
