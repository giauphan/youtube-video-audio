<?php

namespace App\CrawlBlog;

use Giauphan\CrawlBlog\Models\CategoryBlog;
use Giauphan\CrawlBlog\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Weidner\Goutte\GoutteFacade;

class CrawlBlogGoogleNews extends Command
{
    protected $signature = 'crawl:google-new {url} {category_name} {lang} {limitpage}';

    protected $description = 'CrawlBlogGoogleNews blog data from a given URL';

    public function handle()
    {
        $pageUrl = $this->argument('url');
        $categoryName = $this->argument('category_name');
        $lang = $this->argument('lang');
        $limit = $this->argument('limitpage');
        $totaltimes = 0;

        $category = CategoryBlog::firstOrCreate(['name' => $categoryName], ['slug' => Str::slug($categoryName)]);
        $categoryId = $category->id;
        do {
            $crawler = GoutteFacade::request('GET', $pageUrl);

            $crawler->filter('.blog-post-masonry')->each(function ($node) use($categoryId,$lang) {
                $summary = $node->filter('.content h3')->text();
                $image = optional($node->filter('.blog-post-masonry header img')->first())->attr('data-lazy-src');
                $linkHref = $node->filter('.blog-post-masonry header a')->attr('href');

                $this->scrapeData($linkHref, $image, $summary,$categoryId,$lang);
            });
            $nextLink = $crawler->filter('nav.pagination li a.next')->first();
            if ($nextLink->count()  <= 0) {
                break;
            }
            $nextPageUrl = $nextLink->attr('href');

            $pageUrl = $nextPageUrl;
            $totaltimes++;
        } while ($limit > $totaltimes);
    }

    public function scrapeData($url, $image, $summary, $categoryId, $lang)
    {
        $crawler = GoutteFacade::request('GET', $url);
        $title = $this->crawlData('.wrap-container h1', $crawler);
        $content = $this->crawlData_html('#main .post', $crawler);
        $check = Post::all();

        if ($check->isEmpty()) {
            $this->createPost($title, $image, $summary, $content, $categoryId, $lang);
        } else {
            $this->checkAndUpdatePost($title, $image, $summary, $content, $check, $categoryId, $lang);
        }
    }
    protected function createPost($title, $image, $summary, $content,$categoryId,$lang)
    {
        $cleanedTitle = Str::slug($title, '-');
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $cleanedTitle);
        $dataPost = [
            'title' => $title,
            'slug' => $slug,
            'content' => $content,
            'images' => $image,
            'lang' => $lang,
            'published_at' => now(),
            'summary' => $summary,
            'category_blog_id' => $categoryId,
            'SimilarityPercentage' => 0.0,
        ];
        Post::create($dataPost);
    }

    protected function checkAndUpdatePost($title, $image, $summary, $content, $check, $categoryId, $lang)
    {
        $checkTile = false;
        $similarityPercentage = 0.0;

        foreach ($check as $blog) {
            if ($blog->title !== $title) {
                $blog1Words = explode(' ', $blog->content);
                $blog2Words = explode(' ', $content);
                $commonWords = array_intersect($blog1Words, $blog2Words);
                $similarityPercentage += count($commonWords) / count($blog1Words);
            } else {
                $checkTile = true;
            }
        }

        if (! $checkTile && $title != null) {
            $similarityPercentage = $similarityPercentage / $check->count();
            $cleanedTitle = Str::slug($title, '-');
            $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $cleanedTitle).'.html';
            $dataPost = [
                'title' => $title,
                'slug' => $slug,
                'content' => $content,
                'images' => $image,
                'lang' => $lang,
                'published_at' => now(),
                'summary' => $summary,
                'category_blog_id' => $categoryId,
                'SimilarityPercentage' => round($similarityPercentage, 2),
            ];
            Post::create($dataPost);
        }
    }

    protected function crawlData(string $type, $crawler)
    {
        $result = $crawler->filter($type)->first();

        return $result ? $result->text() : '';
    }

    protected function crawlData_html(string $type, $crawler)
    {
        $result = $crawler->filter($type)->first();

        return $result ? $result->html() : '';
    }
}
