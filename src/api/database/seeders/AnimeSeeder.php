<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Anime;

class AnimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('animes')->insert([
            [
                'title' => 'SPY FAMILY',
                'img_file_name' => 'sample_image.png',
                'summary' => '世界各国が水面下で熾烈な情報戦を繰り広げていた時代。東国(オスタニア)と西国(ウェスタリス)は、十数年間にわたる冷戦状態にあった。西国の情報局対東課〈WISE(ワイズ)〉所属である凄腕スパイの〈黄昏(たそがれ)〉は、東西平和を脅かす危険人物、東国の国家統一党総裁ドノバン・デズモンドの動向を探るため、ある極秘任務を課せられる。その名も、オペレーション〈梟(ストリクス)〉。内容は、“一週間以内に家族を作り、デズモンドの息子が通う名門校の懇親会に潜入せよ”。〈黄昏(たそがれ)〉は、精神科医ロイド・フォージャーに扮し、家族を作ることに。だが、彼が出会った娘・アーニャは心を読むことができる超能力者、妻・ヨルは殺し屋だった！　3人の利害が一致したことで、お互いの正体を隠しながら共に暮らすこととなる。',
            ],
            [
                'title' => '名探偵コナン ゼロの日常',
                'img_file_name' => 'sample_image.png',
                'summary' => 'ある時は名探偵毛利小五郎の弟子、安室透。ある時は日本を守る公安警察、降谷零。またある時は、黒ずくめの一員、バーボン。三つの顔(トリプルフェイス)を持つ男のプライベートは誰も知らない......はずだった。光と影をまとう安室透のなんでもない日常（ティータイム）が今、明かされる。',
            ],
            [
                'title' => 'トモダチゲーム',
                'img_file_name' => 'sample_image.png',
                'summary' => '何よりも友情を大切にする高校生・片切 友一は、仲の良い友人・沢良宜志法、美笠 天智、四部誠、心木ゆとりと充実した日々を送っていた。しかし、とある事件をきっかけに、突如5人は多額の借金返済ゲームに巻き込まれていく。「友達を疑わないこと」、それが唯一“トモダチゲーム”をクリアする方法。固い友情で結ばれた彼らにとって、それは簡単すぎるゲームのはずだったが――',
            ],
            [
                'title' => 'かぐや様は告らせたい-ウルトラロマンティック-',
                'img_file_name' => 'sample_image.png',
                'summary' => '秀才たちが集うエリート校・秀知院学園。その生徒会で出会った副会長・四宮かぐやと生徒会長・白銀御行。誰もがお似合いだと認める2人の天才は、すぐに結ばれるのかと思いきや高すぎるプライドが邪魔して告白できずにいた!! “如何にして相手を告白させるか”という恋愛頭脳戦に知略を尽くしてきた歴戦の2人は各々、心の内にとある決心を固める……。秀知院高等部の文化祭“奉心祭”の最終日までに、2人の恋愛模様は大きく動き出す事に!? 恋が天才をアホにする!!新感覚“頭脳戦”？　ウルトラロマンティックなラブコメ、再々始動!!',
            ],
            [
                'title' => 'RPG不動産',
                'img_file_name' => 'sample_image.png',
                'summary' => '秀魔王が倒され、世界が平和になってから15年。風色琴音は、新居を探して「RPG不動産」に訪れるが、実はそこが琴音の就職先だった!同僚は、自由でやんちゃなファー、仕事に厳しい僧侶のルフリア、可憐な見た目と裏腹な強さをもつ戦士のラキラ。琴音は3人と一緒に力を合わせて、家探しに訪れる一風変わったお客さんたちからの無理難題を仲良く楽しく解決しながら、新しい住まいを提供していく。大切な物件探しは「RPG不動産」にお任せください!水のなかでも、雲の上でも、どんな場所だって、きっとあなたが喜んでくれる素敵な物件を見つけてみせます。異世界おしごとファンタジー、開幕!',
            ],
            [
                'title' => '可愛いだけじゃない式守さん',
                'img_file_name' => 'sample_image.png',
                'summary' => '不幸体質の男子高校生・和泉くんの彼女は、同級生の式守さん。笑顔が素敵で優しくて、和泉くんと一緒にいるときはいつも幸せそう。可憐で可愛い、愛情たっぷりの彼女だけど、和泉くんがピンチになったりすると……最高にカッコいい、“イケメン彼女”に大変身！　可愛い×カッコいいに溢れた式守さんと和泉くんや仲良しフレンズによる楽しい日常は止まらない！　尊さ1000%ラブコメ、いよいよスタート!',
            ],
            [
                'title' => 'キングダム 第4シリーズ ',
                'img_file_name' => 'sample_image.png',
                'summary' => '紀元前、中国西方の秦国(しんこく)。今は亡き親友と夢見た「天下の大将軍」を目指す下僕の少年・信(しん)は、王都で起きたクーデターに巻き込まれ、秦王・嬴政(えいせい)と運命的な出会いを果たす。時は流れ、戦場に身を置く信は、同世代の将である蒙恬(もうてん)や王賁(おうほん)らと切磋琢磨しながら武功を重ねて着実に出世を果たし、これまで年若いことを理由に補佐役の相国・呂不韋(りょふい)に国の実権を握られていた嬴政も、その類稀なる才覚によって、弟・成蟜(せいきょう)らかつて対立していた者たちをも味方につけ確実に宮廷内での影響力を強めていた。そんな中起きた函谷関(かんこくかん)攻防戦。趙国(ちょうこく)の天才軍師・李牧(りぼく)と楚国(そこく)の宰相・春申君(しゅんしんくん)の働きかけにより列強五か国が参加することになった合従軍に攻め込まれた秦国は、亡国の危機に国家一丸となって立ち向かいこれを打ち破る。この戦いで嬴政は、自らの才を証明してみせ、まもなく行われる成人の儀式「加冠の儀(かかんのぎ)」において、国内外に向け自らが「第31代秦王」であることを宣言し、国の実権を取り戻すことを誓う。だが、中華全土を巻き込んだ戦いは、攻め込まれた秦国も、合従軍に参加した国々にも大きな爪痕を残した。秦国では、混乱に乗じた内乱を目論む者が現れる。さらには呂不韋が自身の野望達成のための最終段階へと動き出す。国家存亡の危機を乗り越えた秦国に、新たな波乱の兆しが見え始めていた――。',
            ],
            [
                'title' => 'パリピ孔明',
                'img_file_name' => 'sample_image.png',
                'summary' => '三国志の英雄にして天才軍師・諸葛孔明が渋谷に転生！　歌手を目指す英子の歌に心打たれた諸葛孔明は、自ら軍師になることを申し出る……。2人の音楽と物語が、ここから始まる。',
            ],


        ]);
    }
}
