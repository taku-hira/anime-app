<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use App\Http\Controllers\AnimeDataController;
use App\Models\OnAirData;
use App\Models\Anime;

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
            $title = $get_url->getTitle($crawler);
            $anime_on_air_data[$title[0]] = [
                $this->getOnAir($crawler)
            ];
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
                $on_air_date_list[] = $key;
                $on_air_info_list[] = $data;
            }
        }
        $this->insertOnAirdata($title_list, $on_air_date_list, $on_air_info_list);
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
        if (mb_strpos($string, '日') === 3) {
            $on_air_date = mb_substr($string, 0, 4);
            $on_air_info = mb_substr($string, 8);
            $on_air_date = str_replace('月', '-', $on_air_date);
            $on_air_date = str_replace('日', '', $on_air_date);
            $on_air_info = str_replace('#', 'エピソード', $on_air_info);
            return [$on_air_date => $on_air_info];
        } elseif (mb_strpos($string, '日') === 4) {
            $on_air_date = mb_substr($string, 0, 5);
            $on_air_info = mb_substr($string, 9);
            $on_air_date = str_replace('月', '-', $on_air_date);
            $on_air_date = str_replace('日', '', $on_air_date);
            $on_air_info = str_replace('#', 'エピソード', $on_air_info);
            return [$on_air_date => $on_air_info];
        } elseif (mb_strpos($string, '日') === 5) {
            $on_air_date = mb_substr($string, 0, 6);
            $on_air_info = mb_substr($string, 10);
            $on_air_date = str_replace('月', '-', $on_air_date);
            $on_air_date = str_replace('日', '', $on_air_date);
            $on_air_info = str_replace('#', 'エピソード', $on_air_info);
            return [$on_air_date => $on_air_info];
        }
    }

    public function insertOnAirdata($title, $date, $info)
    {
        $params =[];
        for ($i = 0; $i < count($title); $i ++) {
            $anime_title = Anime::where('title', '=', $title[$i])->first();
            if ($anime_title) {
                $params[] = [
                    'anime_id' => $anime_title->id,
                    'on_air_date' => date('Y-m-d', strtotime('2022-' . $date[$i])),
                    'on_air_info' => $info[$i],
                ];
            }
        }
        OnAirData::upsert($params, 'id');
    }

    public function getLatestOnAirData($anime_id)
    {
        $on_air_data = OnAirData::where(
            'anime_id', '=', $anime_id,
            )->latest()->first();
        if ($on_air_data) {
            return response()->json([
                'date' => date('Y年m月d日', strtotime($on_air_data->on_air_date)),
                'info' => $on_air_data->on_air_info,
            ], 200);
        } else {
            return response()->json([
                'message' => '番組情報はありません'
            ], 200);
        }
    }
}
