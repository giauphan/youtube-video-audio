<?php

namespace App\CrawlBlog;

use Carbon\Carbon;
use Giauphan\CrawlBlog\Models\CategoryBlog;
use Giauphan\CrawlBlog\Models\Post;
use Giauphan\Goutte\GoutteFacade;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class BotBlogTechNewWorld extends Command
{
    protected $signature = 'crawl:BotBlogTechNewsWorld {url} {limitblog}';

    protected $description = 'BotBlogTechNewWorld blog data from a given URL';

    public function handle()
    {
        $pageUrl = $this->argument('url');
        $limit = $this->argument('limitblog');

        $arr_data = [];
        $totaltimes = 0;
        do {
            $crawler = GoutteFacade::request('GET', $pageUrl);

            $crawl_arr = $crawler->filter('.product-grid-item');
            if ($crawl_arr->count() === 0) {
                $this->error('No matching elements found on the page. Check if the HTML structure has changed.');
                break;
            }
            $category = $crawler->filter('.category-title')->text();

            foreach ($crawl_arr as $node) {
                try {
                    if ($node instanceof \DOMElement) {
                        $node = new Crawler($node);
                    }
                    $title = $this->checkCrawl('.product-grid-title', $node) == '' ? $this->checkCrawl('.product-grid-title', $node) : $this->checkCrawl('.product-grid-title', $node)->text();
                    $price = $this->checkCrawl('.product-grid-price', $node)->text();
                    $image = optional($this->checkCrawl('.product-grid-thumb img', $node)->first())->attr('src');
                    $linkHref = $this->checkCrawl('.product-grid-info', $node)->attr('href');
                   
                    // $detail = $this->scrapeData( $linkHref);

                    $arr_data[]  = [
                        'category' =>  $category,
                        'title' => $title,
                        'image' => $image,
                        'linkHref' =>  $linkHref,
                        'price' => $price,
                        // 'description' =>  $detail
                    ];

                    $totaltimes++;
                    if ($totaltimes >= $limit) {
                        $this->info('Reached the limit.');
                        break 2;
                    }
                } catch (\Exception $e) {
                }
            }

            $nextLink = $crawler->filter('.pagination-link-next')->first();
            if ($nextLink->count() <= 0) {
                break;
            }
            
            $nextPageUrl = $nextLink->attr('href');
            $pageUrl = $nextPageUrl;
        } while ($pageUrl !== '');
        dd(($arr_data));
    }

    public function scrapeData($url)
    { 
        $crawler = GoutteFacade::request('GET', 'https://mwc.com.vn' . $url);
        $content = $this->crawlData_html('#product-detail-des', $crawler);
        return   $content;
    }

    public function checkCrawl(string $type, $crawler)
    {

        $nodeList = $crawler->filter($type);
        if ($nodeList->count() === 0) {
            $this->error($type . ' node list is empty.  ');
            return null;
        }

        return $nodeList;
    }
}
