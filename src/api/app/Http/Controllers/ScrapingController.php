<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use App\Models\Anime;

class ScrapingController extends Controller
{
    public function getAnimeData()
    {
        $client = new Client();
        $client = new Client(HttpClient::create(['timeout' => 60]));
        //詳細ページのURL取得
        $crawler = $client->request('GET', 'https://anime.eiga.com/program/');
        $anime_url = $crawler->filter('.animeSeasonBox')->each(function ($element) {
            return 'https://anime.eiga.com' . $element->filter('a')->attr('href');
        });
        foreach ($anime_url as $url) {
            $crawler = $client->request('GET', $url);
            // タイトル取得
            $anime_title = $crawler->filter('.headArea h1')->each(function ($element) {
                if ($element->filter('.headTtlL')->count() > 0) {
                    return $element->filter('.headTtlL')->text();
                }
            });
            // あらすじ取得
            $anime_summary = $crawler->filter('.animeTopContainer')->each(function ($element) {
                if ($element->filter('.animeDetailBox')->filter('dl#detailSynopsis')->filter('dd')->count() > 0) {
                    return $element->filter('.animeDetailBox')->filter('dl#detailSynopsis')->filter('dd')->text();
                } else {
                    return $element->filter('.animeDetailBox')->filter('dl#detailLink')
                                    ->filter('dd')->filter('.clearfix a')->attr('href');
                }
            });
            // 画像URL取得
            $anime_img = $crawler->filter('.animeTopContainer')->each(function ($element) {
                if ($element->filter('.animeDetailBox')->filter('.animeDetailImg img')->count() > 0) {
                    return $element->filter('.animeDetailBox')->filter('.animeDetailImg img')->attr('src');
                }
            });
            $anime_data[] = [
                'title' => $anime_title,
                'summary' => $anime_summary,
                'img' =>  $anime_img,
            ];
        }
        // 取得したデータをanimesテーブルに保存
        foreach ($anime_data as $data) {
            $anime = new Anime();
            $anime->title = $data['title'][0];
            $anime->summary = $data['summary'][0];
            $anime->img_file_name = $data['img'][0];
            $anime->save();
        }
    }
}
