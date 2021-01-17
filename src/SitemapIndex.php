<?php

namespace Dvomaks\Sitemap;

use Dvomaks\Sitemap\Tags\Sitemap;
use Dvomaks\Sitemap\Tags\Tag;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class SitemapIndex implements Responsable
{
    /** @var array */
    protected $tags = [];

    /**
     * @return static
     */
    public static function create(): SitemapIndex
    {
        return new static();
    }

    /**
     * @param string|Tag $tag
     *
     * @return $this
     */
    public function add($tag): self
    {
        if (is_string($tag)) {
            $tag = Sitemap::create($tag);
        }

        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Get sitemap tag.
     *
     * @param string $url
     *
     * @return Sitemap|null
     */
    public function getSitemap(string $url): ?Sitemap
    {
        return collect($this->tags)->first(function (Tag $tag) use ($url) {
            return $tag->getType() === 'sitemap' && $tag->url === $url;
        });
    }

    /**
     * Check if there is the provided sitemap in the index.
     *
     * @param string $url
     *
     * @return bool
     */
    public function hasSitemap(string $url): bool
    {
        return (bool) $this->getSitemap($url);
    }

    /**
     * Get the inflated template content.
     *
     * @return string
     * @throws Throwable
     */
    public function render(): string
    {
        $tags = $this->tags;

        return view('dvomaks-sitemap::sitemapIndex/index')
            ->with(compact('tags'))
            ->render();
    }

    /**
     * @param string $path
     *
     * @return $this
     * @throws Throwable
     */
    public function writeToFile(string $path): self
    {
        file_put_contents($path, $this->render());

        return $this;
    }

    public function writeToDisk(string $disk, string $path): self
    {
        Storage::disk($disk)->put($path, $this->render());

        return $this;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param Request $request
     * @return Response
     * @throws Throwable
     */
    public function toResponse($request): Response
    {
        return Response::make($this->render(), 200, [
            'Content-Type' => 'text/xml',
        ]);
    }
}

