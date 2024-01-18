<?php

namespace App\CrawlBlog;

use Carbon\Carbon;
use Giauphan\CrawlBlog\Models\CategoryBlog;
use Giauphan\CrawlBlog\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;
use Weidner\Goutte\GoutteFacade;

class BotBlogTechNewWorld extends Command
{
    protected $signature = 'crawl:BotBlogTechNewsWorld {url} {category_name} {lang} {limitblog}';

    protected $description = 'BotBlogTechNewWorld blog data from a given URL';

    public function handle()
    {
        $pageUrl = $this->argument('url');
        $categoryName = $this->argument('category_name');
        $lang = $this->argument('lang');
        $limit = $this->argument('limitblog');

        $category = CategoryBlog::firstOrCreate(['name' => $categoryName], ['slug' => Str::slug($categoryName)]);
        $categoryId = $category->id;

        $totaltimes = 0;

        $category = CategoryBlog::firstOrCreate(['name' => $categoryName], ['slug' => Str::slug($categoryName)]);
        do {
            $crawler = GoutteFacade::request('GET', $pageUrl);

            $crawl_arr = $crawler->filter('.search-item');
            if ($crawl_arr->count() === 0) {
                $this->error('No matching elements found on the page. Check if the HTML structure has changed.');
                break;
            }

            foreach ($crawl_arr as $node) {
                try {
                    if ($node instanceof \DOMElement) {
                        $node = new Crawler($node);
                    }
                    $title = $this->checkCrawl('.search-txt h2', $node)->text();
                    $summary = $this->checkCrawl('.search-item p', $node)->text();
                    $image = optional($this->checkCrawl('.search-pic img', $node)->first())->attr('src');
                    $linkHref = $this->checkCrawl('.search-txt a', $node)->attr('href');
                    $this->scrapeData($linkHref, $title, $image, $summary, $category, $lang);

                    $totaltimes++;

                    if ($totaltimes >= $limit) {
                        $this->info('Reached the limit.');
                        break 2;
                    }
                } catch (\Exception $e) {
                    dump($e);
                }
            }

            $nextLink = $crawler->filter('nav.pagination li a.next')->first();
            if ($nextLink->count() <= 0) {
                break;
            }
            $nextPageUrl = $nextLink->attr('href');
            $pageUrl = $nextPageUrl;
        } while ($pageUrl !== '');
    }

    public function scrapeData($url, $title, $image, $summary, $category, $lang)
    {
        $crawler = GoutteFacade::request('GET', $url);
        $content = $this->crawlData_html('.story-content ', $crawler);
        $check = Post::all();

        if ($check->isEmpty()) {
            $this->createPost($title, $image, $summary, $content, $category, $lang, $url);
        } else {
            $this->checkAndUpdatePost($title, $image, $summary, $content, $check, $category, $lang, $url);
        }
    }

    protected function createPost($title, $image, $summary, $content, $category, $lang, $url)
    {
        $cleanedTitle = Str::slug($title, '-');
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $cleanedTitle);
        $dataPost = [
            'title' => $title,
            'slug' => $slug,
            'content' => $content.'\n '."<a href='$url'>Original blog link is here</a>",
            'images' => $image,
            'lang' => $lang,
            'published_at' => Carbon::now()->addMinutes(30),
            'summary' => $summary,
            'SimilarityPercentage' => 0.0,
        ];
          $category->posts()->create($dataPost);

    }

    protected function checkAndUpdatePost($title, $image, $summary, $content, $check, $category, $lang, $url)
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
            $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $cleanedTitle).'';
            $dataPost = [
                'title' => $title,
                'slug' => $slug,
                'content' => $content.'\n '."<a href='$url'>Original blog link is here</a>",
                'images' => $image,
                'lang' => $lang,
                'published_at' => Carbon::now()->addMinutes(30),
                'summary' => $summary,
                'SimilarityPercentage' => round($similarityPercentage, 2),
            ];
            $category->posts()->create($dataPost);
        }
    }

    public function checkCrawl(string $type, $crawler)
    {
        $nodeList = $crawler->filter($type);
        if ($nodeList->count() === 0) {
            $this->error($type.' node list is empty.  ');

            return '';
        }

        return $nodeList;
    }

    protected function crawlData(string $type, $crawler)
    {
        $nodeList = $crawler->filter($type);
        if ($nodeList->count() === 0) {
            return '';
        }

        $result = $nodeList->first();

        return $result ? $result->text() : '';
    }

    protected function crawlData_html(string $type, $crawler)
    {
        $nodeList = $crawler->filter($type);
        if ($nodeList->count() === 0) {
            return '';
        }

        $result = $nodeList->first();

        return $result ? $result->html() : '';
    }
}
