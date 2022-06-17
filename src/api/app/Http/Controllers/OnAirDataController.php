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
        $i = 0;
        foreach ($anime_url as $url) {
            if ($i > 3) {
                break;
            }
            $crawler = $client->request('GET', $url);
            $title = $get_url->getTitle($crawler);
            $anime_on_air_data[$title[0]] = [
                $this->getOnAir($crawler)
            ];
            $i ++;
        }
        foreach ($anime_on_air_data as $key => $on_air_data) {
            foreach($on_air_data as $data) {
                foreach ($data as $value) {
                    $title_list[] = $key;
                    $info_list[] = $value;
                }
            }
        }
        $format_data = array_map(array($this, 'splitCharacters'), $info_list);
        foreach ($format_data as $on_air_data) {
            foreach ($on_air_data as $key => $data) {
                $on_air_day_list[] = $key;
                $on_air_info_list[] = $data;
            }
        }
        dd($title_list, $on_air_day_list, $on_air_info_list);
        $this->insertOnAirdata($title_list, $on_air_day_list, $on_air_info_list);
    }

    public function getOnAir($crawler)
    {
        $anime_on_air_day = $crawler->filter('.tvScheList')->each(function ($element) {
            if ($element->count() > 0) {
                return $element->text();
            }
        });
        return $anime_on_air_day;
    }

    public function splitCharacters($string)
    {
        $on_air_day = mb_substr($string, 0, 5);
        $on_air_info = mb_substr($string, 9);
        return [$on_air_day => $on_air_info];
    }

    public function insertOnAirdata($title, $day, $info)
    {
        
    }
}
