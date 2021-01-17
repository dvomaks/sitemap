<?php

namespace Dvomaks\Sitemap\Tags;

class Alternate
{
    /** @var string */
    public $locale;

    /** @var string */
    public $url;

    public static function create(string $url, string $locale = ''): self
    {
        return new static($url, $locale);
    }

    public function __construct(string $url, $locale = '')
    {
        $this->setUrl($url);

        $this->setLocale($locale);
    }

    /**
     * @param string $locale
     *
     * @return $this
     */
    public function setLocale(string $locale = ''): self
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setUrl(string $url = ''): self
    {
        $this->url = $url;

        return $this;
    }
}
