<?php

namespace App\Models;

use Giauphan\CrawlBlog\Models\CategoryBlog as ModelsCategoryBlog;
use Laravel\Scout\Searchable;

class CategoryBlog extends ModelsCategoryBlog
{
    use Searchable;
}
