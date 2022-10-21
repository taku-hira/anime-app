<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use App\Models\Anime;

use function PHPUnit\Framework\at;

class AnimeDataController extends Controller
{
    public function getAnimeData()
    {
        $client = new Client();
        $client = new Client(HttpClient::create(['timeout' => 60]));
        $anime_url = $this->getUrl($client);
        foreach ($anime_url as $url) {
            $crawler = $client->request('GET', $url);
            $anime_title = $this->getTitle($crawler);
            $official_site_url = $this->getOfficialUrl($crawler);
            $anime_summary = $this->getSummary($crawler);
            $anime_img_url = $this->getImageUrl($crawler);
            $on_air_season = $this->getOnAirSeason($crawler);
            $anime_data[] = [
                'title' => $anime_title,
                'official_site_url' => $official_site_url,
                'summary' => $anime_summary,
                'img_file_name' => $anime_img_url,
                'on_air_season' => $on_air_season
            ];
        }
        $this->insertAnimeDb($anime_data);
    }

    public function getUrl($client)
    {
        $crawler = $client->request('GET', 'https://anime.eiga.com/program/');
        $anime_url = $crawler->filter('.animeSeasonBox')->each(function ($element) {
            return 'https://anime.eiga.com' . $element->filter('a')->attr('href');
        });
        return $anime_url;
    }

    public function getTitle($crawler)
    {
        $anime_title = $crawler->filter('.headArea h1')->each(function ($element) {
            if ($element->filter('.headTtlL')->count() > 0) {
                return $element->filter('.headTtlL')->text();
            }
        });
        return $anime_title;
    }

    public function getSummary($crawler)
    {
        $anime_summary = $crawler->filter('.animeTopContainer')->each(function ($element) {
            if ($element->filter('.animeDetailBox')->filter('dl#detailSynopsis')->filter('dd')->count() > 0) {
                return $element->filter('.animeDetailBox')->filter('dl#detailSynopsis')->filter('dd')->text();
            } else {
                return $element->filter('.animeDetailBox')->filter('dl#detailLink')
                                ->filter('dd')->filter('.clearfix a')->attr('href');
            }
        });
        return $anime_summary;
    }

    public function getOfficialUrl($crawler)
    {
        $anime_official_url = $crawler->filter('dl#detailLink')->each(function ($element) {
            if ($element->filter('dd')->filter('.clearfix a')->count() > 0) {
                return $element->filter('dl#detailLink')->filter('dd')->filter('.clearfix a')->attr('href');
            }
        });
        return $anime_official_url;
    }

    public function getImageUrl($crawler)
    {
        $anime_img_url = $crawler->filter('.animeTopContainer')->each(function ($element) {
            if ($element->filter('.animeDetailBox')->filter('.animeDetailImg img')->count() > 0) {
                return $element->filter('.animeDetailBox')->filter('.animeDetailImg img')->attr('src');
            }
        });
        return $anime_img_url;
    }

    public function getOnAirSeason($crawler)
    {
        $on_air_season = $crawler->filter('.animeSeasonTag')->each(function ($element) {
            if ($element->filter('.seasonText a')->count() > 0) {
                return $element->filter('.seasonText a')->text();
            }
        });
        return $on_air_season;
    }

    public function insertAnimeDb($anime_data)
    {
        foreach ($anime_data as $data) {
            $anime = new Anime();
            $anime->title = $data['title'][0];
            $anime->summary = $data['summary'][0];
            if (isset($data['official_site_url'][0])) {
                $anime->official_site_url = $data['official_site_url'][0];
            } else {
                $anime->official_site_url = null;
            }
            $anime->img_file_name = $data['img_file_name'][0];
            $anime->on_air_season = $data['on_air_season'][0];
            $anime->save();
        }
    }
}
