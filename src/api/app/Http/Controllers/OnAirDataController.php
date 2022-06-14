<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use App\Http\Controllers\AnimeDataController;

class OnAirDataController extends Controller
{
    public function getOnAirData()
    {
        $client = new Client();
        $client = new Client(HttpClient::create(['timeout' => 60]));
        $get_url = new AnimeDataController();
        $anime_url = $get_url->getUrl($client);
        foreach ($anime_url as $url) {
            $crawler = $client->request('GET', $url);
            // $on_air_day = $this->getOnAirDay($crawler);
            // $on_air_time = $this->getOnAirTime($crawler);
            $data[] = [
                'on_air_day' => $this->getOnAirDay($crawler),
                'on_air_time' => $this->getOnAirTime($crawler),
            ];
        }
        dd($data);
    }

    function getOnAir($crawler)
    {
        $anime_on_air_day = $crawler->filter('.tvScheList')->each(function ($element) {
            if ($element->count() > 0) {
                return $element->text();
            }
        });
        return $anime_on_air_day;
    }

    function getOnAirDay($crawler)
    {
        $anime_on_air_day = $crawler->filter('.tvScheListDate')->each(function ($element) {
            if ($element->count() > 0) {
                return $element->filter('.tvScheListDate')->text();
            }
        });
        return $anime_on_air_day;
    }

    function getOnAirTime($crawler)
    {
        $anime_on_air_time = $crawler->filter('.tvScheList')->filter('.clearfix')->each(function ($element) {
            if ($element->count() > 0) {
                return $element->filter('.tvScheTime')->text();
            }
        });
        return $anime_on_air_time;
    }

}
