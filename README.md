# Generate sitemaps with ease

You can create your sitemap manually:

```php
use Carbon\Carbon;
use Dvomaks\Sitemap\Sitemap;
use Dvomaks\Sitemap\Tags\Url;

Sitemap::create()

    ->add(Url::create('/home')
        ->setLastModificationDate(Carbon::yesterday())
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
        ->setPriority(0.1))

   ->add(...)

   ->writeToFile($path);
```

## Installation

First, install the package via composer:

```bash
composer require dvomaks/sitemap
```

The package will automatically register itself.

## Usage



### Manually creating a sitemap

You can also create a sitemap fully manual:

```php
use Carbon\Carbon;

Sitemap::create()
   ->add('/page1')
   ->add('/page2')
   ->add(Url::create('/page3')->setLastModificationDate(Carbon::create('2016', '1', '1')))
   ->writeToFile($sitemapPath);
```

### Creating a sitemap index
You can create a sitemap index:
```php
use Dvomaks\Sitemap\SitemapIndex;

SitemapIndex::create()
    ->add('/pages_sitemap.xml')
    ->add('/posts_sitemap.xml')
    ->writeToFile($sitemapIndexPath);
```

You can pass a `Dvomaks\Sitemap\Tags\Sitemap` object to manually set the `lastModificationDate` property.

```php
use Dvomaks\Sitemap\SitemapIndex;
use Dvomaks\Sitemap\Tags\Sitemap;

SitemapIndex::create()
    ->add('/pages_sitemap.xml')
    ->add(Sitemap::create('/posts_sitemap.xml')
        ->setLastModificationDate(Carbon::yesterday()))
    ->writeToFile($sitemapIndexPath);
```

the generated sitemap index will look similar to this:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
   <sitemap>
      <loc>http://www.example.com/pages_sitemap.xml</loc>
      <lastmod>2016-01-01T00:00:00+00:00</lastmod>
   </sitemap>
   <sitemap>
      <loc>http://www.example.com/posts_sitemap.xml</loc>
      <lastmod>2015-12-31T00:00:00+00:00</lastmod>
   </sitemap>
</sitemapindex>
```
