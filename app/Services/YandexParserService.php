<?php

namespace App\Services;

use DateTime;

class YandexParserService
{
    public function parseReviews(string $url)
    {
        $browser = new \Symfony\Component\BrowserKit\HttpBrowser(\Symfony\Component\HttpClient\HttpClient::create([
            'headers' => ['User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/121.0.0.0 Safari/537.36']
        ]));

        $crawler = $browser->request('GET', $url);

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
            'reviews' => array_values(array_filter($reviews, fn($r) => !empty($r['text']))),
            'zzz' => $crawler
        ];
    }
}
