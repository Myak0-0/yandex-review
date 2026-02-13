<?php

namespace App\Services;

use DateTime;

class YandexParserService
{
    public function parseReviews(string $url)
    {
        $scrapingant = 'https://api.scrapingant.com/v2/general';
        $api_scrapingant = '0f7430376a954ac696885e8943f7b4d4';

        $proxyUrl = $scrapingant . '?url=' . urlencode($url) . '&x-api-key=' . $api_scrapingant;

        $response = file_get_contents($proxyUrl);
        
        $crawler = new \Symfony\Component\DomCrawler\Crawler($response);

        $rating = '';
        $crawler->filter('.business-summary-rating-badge-view__rating-text')->each(function ($node) use (&$rating) {
            $rating .= $node->text();
        });
        $rating = (float)str_replace(',', '.', $rating);

        $countText = $crawler->filter('[class*="rating-amount-view"]')->count() 
            ? $crawler->filter('[class*="rating-amount-view"]')->first()->text() 
            : '0';

        $reviews = $crawler->filter('[itemprop="review"]')->each(function ($node) {
            $author = $node->filter('[itemprop="name"]')->count() ? $node->filter('[itemprop="name"]')->text() : 'Аноним';
            $stars = $node->filter('meta[itemprop="ratingValue"]')->count() ? (int)$node->filter('meta[itemprop="ratingValue"]')->attr('content') : 0;
            $text = $node->filter('[itemprop="reviewBody"]')->count() ? $node->filter('[itemprop="reviewBody"]')->text() : '';

            $dateRaw = $node->filter('meta[itemprop="datePublished"]')->count() ? $node->filter('meta[itemprop="datePublished"]')->attr('content') : 'нет даты';
            $date = (new DateTime($dateRaw))->format('d.m.Y H:i');

            return [
                'author' => trim($author),
                'stars'  => $stars,
                'text'   => trim(str_replace('Ещё', '', $text)),
                'date'   => $date
            ];
        });

        return [
            'rating' => $rating ?: 0,
            'reviews_count' => $countText,
            'reviews' => array_values(array_filter($reviews, fn($r) => !empty($r['text'])))
        ];
    }
}
