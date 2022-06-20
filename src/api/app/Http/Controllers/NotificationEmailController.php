<?php

namespace App\Http\Controllers;

use App\Mail\BroadcastNotficationEmail;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\OnAirData;
use App\Models\Anime;
use App\Models\User;
use Carbon\Carbon;

class NotificationEmailController extends Controller
{
    public function send()
    {
        $today_anime_list = OnAirData::whereDate('on_air_date', Carbon::today())
                            ->with('anime.favoriteUsers')->get();
        foreach ($today_anime_list as $today_anime) {
            $anime_id = $today_anime->anime->id;
            $anime_title = $today_anime->anime->title;
            $on_air_date = $today_anime->on_air_date;
            $on_air_info = $today_anime->on_air_info;
            $users = Anime::findOrFail($anime_id)->favoriteUsers;
            foreach ($users as $user) {
                $name = $user->name;
                $email = $user->email;
                Mail::send(new BroadcastNotficationEmail($name, $email, $anime_title, $on_air_date, $on_air_info));
            }
        }
    }
}
