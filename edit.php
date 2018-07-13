<?php
/*
just for fun
*/
require_once('./line_class.php');
require_once('./unirest-php-master/src/Unirest.php');
$channelAccessToken = 'pm+pwaVusRIVFAXcFUb3Kt6XAEiS1Zyyfuztxw41ZKooasW4oLWrgdLFwwaEis1zT8bgTPXRnSwf1/0mo/PEijrYgL3IsegmgZ1HjvGRhqHH0+ipE3q+/SpgRzYMrUrnDgVITGAdxSELajCOpZ8SzwdB04t89/1O/w1cDnyilFU='; //sesuaikan
$channelSecret = 'db9ff33196397121d8271987dda3966b';//sesuaikan
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
$userId 	= $client->parseEvents()[0]['source']['userId'];
$groupId 	= $client->parseEvents()[0]['source']['groupId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$timestamp	= $client->parseEvents()[0]['timestamp'];
$type 		= $client->parseEvents()[0]['type'];
$message 	= $client->parseEvents()[0]['message'];
$messageid 	= $client->parseEvents()[0]['message']['id'];
$profil = $client->profil($userId);
$pesan_datang = explode(" ", $message['text']);
$msg_type = $message['type'];
$command = $pesan_datang[0];
$options = $pesan_datang[1];
if (count($pesan_datang) > 2) {
    for ($i = 2; $i < count($pesan_datang); $i++) {
        $options .= '+';
        $options .= $pesan_datang[$i];
    }
}
#-------------------------[Function]-------------------------#
function instainfo($keyword) {
    $uri = "https://farzain.com/api/ig_profile.php?id=" . $keyword . "&apikey=odu7493747dundjdjd";
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $parsed['poto']      = $json['info']['profile_pict'];
    $parsed['nama']      = $json['info']['full_name'];
    $parsed['username']  = $json['info']['username'];
    $parsed['followers'] = $json['count']['followers'];
    $parsed['following'] = $json['count']["following"];
    $parsed['totalpost'] = $json['count']['post'];
    $parsed['bio']       = $json['info']['bio'];
    $parsed['bawah']     = 'https://www.instagram.com/'. $keyword;
    return $parsed;
}
function mirip($keyword) {
    $uri = "https://farzain.com/api/mirip.php?name=" . $keyword . "&apikey=odu7493747dundjdjd";
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $parsed['pap']  = $json['result']['image'];
    $parsed['info'] = $json['result']['result'];
    return $parsed;
}
function ahli($keyword) {
    $uri = "https://farzain.com/api/ahli.php?name=" . $keyword . "&apikey=odu7493747dundjdjd";
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $parsed['pap']  = $json['result']['image'];
    $parsed['info'] = $json['result']['result'];
    return $parsed;
}
function liburan($keyword) {
    $uri = "https://farzain.com/api/libur.php?name=" . $keyword . "&apikey=odu7493747dundjdjd";
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $parsed['pap']  = $json['result']['image'];
    $parsed['info'] = $json['result']['result'];
    return $parsed;
}
function send($input, $rt){
    $send = array(
        'replyToken' => $rt,
        'messages' => array(
            array(
                'type' => 'text',					
                'text' => $input
            )
        )
    );
    return($send);
}
function jawabs($keyword){
    $listnya = array(
        'Ya',
        'Bisa jadi',
        'Mungkin',
        'Gak tau',
	'Tidak',   
    );
    $jaws = array_rand($listnya);
    $jawab = $listnya[$jaws];
    return($jawab);
}
function kenapa($keyword){
    $listnya = array(
        'dia sedang mempunyai masalah pribadi',
        'dia lagi gabut','memang begitu dari sananya :v',
        'sudah kebiasaan jadi susah ngilanginnya :v',
        'dia sedang bahagia',
    );
    $jaws = array_rand($listnya);
    $jawab = $listnya[$jaws];
    return($jawab);
}
function mengapa($keyword){
    $listnya = array(
        'dia sedang mempunyai masalah pribadi',
        'dia lagi gabut','memang begitu dari sananya :v',
        'sudah kebiasaan jadi susah ngilanginnya :v',
        'dia sedang bahagia', 
    );
    $jaws = array_rand($listnya);
    $jawab = $listnya[$jaws];
    return($jawab);
}
function kapan($keyword){
    $listnya = array(
        'Hari ini',
        'Besok',
        'lusa',
        'Setelah laut mengering',
        'Sebulan lagi',
        'Setahun lagi',
    );
    $jaws = array_rand($listnya);
    $jawab = $listnya[$jaws];
    return($jawab);
}
function dimana($keyword){
    $listnya = array(
        'di comberan',
        'di rumah',
        'di luar angkasa',
        'di tempat dugem',
        'dirumah',
        'di tempat nongkrong',
        'di warnet',
        'di arab',
        'di jalan raya',
    );
    $jaws = array_rand($listnya);
    $jawab = $listnya[$jaws];
    return($jawab);
}
function mood($keyword){
    $listnya = array(
        'Presentase mood ' . $keyword . ' adalah 0%',
        'Presentase mood ' . $keyword . ' adalah 10%',
        'Presentase mood ' . $keyword . ' adalah 20%',
        'Presentase mood ' . $keyword . ' adalah 30%',
        'Presentase mood ' . $keyword . ' adalah 40%',
        'Presentase mood ' . $keyword . ' adalah 50%',
        'Presentase mood ' . $keyword . ' adalah 60%',
        'Presentase mood ' . $keyword . ' adalah 70%',
        'Presentase mood ' . $keyword . ' adalah 80%',
        'Presentase mood ' . $keyword . ' adalah 90%',
        'Presentase mood ' . $keyword . ' adalah 100%',
    );
    $jaws = array_rand($listnya);
    $jawab = $listnya[$jaws];
    return($jawab);
}
function status($keyword){
    $listnya = array(
        'Hidup',
        'Nikah',
        'Single',
        'Jones',
        'Hode',
        'Nganggur',
        'Stress',
        'Sultan',
        'Miskin',
        'Badmood',
    );
    $jaws = array_rand($listnya);
    $jawab = $listnya[$jaws];
    return($jawab);
}
function lokasi($keyword){
    $listnya = array(
        'Di bumi',
        'Di darat',
        'Di pantai',
        'Di Goa',
        'Di Laut',
        'Di pulau terpencil',
        'Di warnet',
        'Ditempat dugem',
    );
    $jaws = array_rand($listnya);
    $jawab = $listnya[$jaws];
    return($jawab);
}
function cita($keyword){
    $listnya = array(
        'Tukang kredit',
        'Gamer noob',
        'Nikah seumur hidup',
        'Dokter cinta',
        'Tukang gabut',
        'Tukang Gosip',
    );
    $jaws = array_rand($listnya);
    $jawab = $listnya[$jaws];
    return($jawab);
}
function aktifitas($keyword){
    $listnya = array(
        'Liat postingan org',
        'Gabut',
        'Nyider',
        'Like postingan org',
        'Nongkrong',
        'Ngegame',
        'Dugem',
        'Nge DJ',
    );
    $jaws = array_rand($listnya);
    $jawab = $listnya[$jaws];
    return($jawab);
}
function tinggi($keyword){
    $listnya = array(
        'lebih dari 1 mm',
        '50 cm',
        '2 m',
        '1,5 m',
        '4 m',
        'Tak terhingga',
    );
    $jaws = array_rand($listnya);
    $jawab = $listnya[$jaws];
    return($jawab);
}
function berat($keyword){
    $listnya = array(
        'Sekilo',
        'Seberat pensil',
        'Se ton',
        '50 kg',
        'Seberat sumo',
        'Tak terhingga',
    );
    $jaws = array_rand($listnya);
    $jawab = $listnya[$jaws];
    return($jawab);
}
function bentuktubuh($keyword){
    $listnya = array(
        'Sixpack',
        'segitiga',
        'seperti lidi',
        'Gendut',
        'Ramping',
        'Kotak',
    );
    $jaws = array_rand($listnya);
    $jawab = $listnya[$jaws];
    return($jawab);
}
function hobi($keyword){
    $listnya = array(
        'Godain mantan',
        'Ngesot dijalan raya',
        'Godain mantan orang',
        'Stalking',
        'Ngelap batu akik',
        'Makan kuaci',
        'Ngitung butiran mecin',
    );
    $jaws = array_rand($listnya);
    $jawab = $listnya[$jaws];
    return($jawab);
}
function nasib($keyword){
    $listnya = array(
        'Suka di php',
        'Baik baik saja',
        'Selalu hoki',
        'Selalu zonk',
        'Terjebak masalah',
        'Mendadak miskin',
        'Mendadak kaya',
    );
    $jaws = array_rand($listnya);
    $jawab = $listnya[$jaws];
    return($jawab);
}
#-------------------------[Function]-------------------------#
# require_once('./src/function/search-1.php');
# require_once('./src/function/download.php');
# require_once('./src/function/random.php');
# require_once('./src/function/search-2.php');
# require_once('./src/function/hard.php');
if ($type == 'join') {
    $text = "Thx telah di undang ke grup. silakan ketik /key.\n\nJangan lupa add OA FGM\nhttp://line.me/R/ti/p/~@wcf4912l";
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $text
            )
        )
    );
}
if($message['type']=='text') {
    if ($command == '/cuaaaaaaa') {
        $result = cuaca($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'done'
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == '/key') {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array (
                    'type' => 'template',
                    'altText' => 'Keyword FGM Bot',
                    'template' => 
                    array (
                        'type' => 'buttons',
                        'actions' => 
                        array (
                            0 => 
                            array (
                                'type' => 'message',
                                'label' => 'Hiburan',
                                'text' => '/hiburan',
                            ),
                            1 => 
                            array (
                                'type' => 'message',
                                'label' => 'Alat',
                                'text' => '/alat',
                            ),
                            2 => 
                            array (
                                'type' => 'message',
                                'label' => 'About',
                                'text' => '/about',
                            ),
                            3 => 
                            array (
                                'type' => 'uri',
                                'label' => 'OA FGM',
                                'uri' => 'http://line.me/R/ti/p/~@wcf4912l',
                            ),
                        ),
                        'title' => 'FGM Bot Keywords',
                        'text' => 'Klik Salah satu menu dibawah ini',
                    ),
                )
            )
        );
    }
}
//======================Fitur hiburan================================
if($message['type']=='text') {
    if ($command == '/hiburan') {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array (
                    'type' => 'template',
                    'altText' => 'this is a carousel template',
                    'template' => 
                    array (
                        'type' => 'carousel',
                        'actions' => 
                        array (
                        ),
                        'columns' => 
                        array (
                            0 => 
                            array (
                                'title' => 'Fitur Hiburan',
                                'text' => 'Halaman 1',
                                'actions' =>
                                array (
                                    0 => 
                                    array (
                                        'type' => 'message',
                                        'label' => 'Kerang Ajaib',
                                        'text' => '/apakah<spasi><teks>',
                                    ),
                                    1 => 
                                    array (
                                        'type' => 'message',
                                        'label' => 'Penjawab Pertanyaan',
                                        'text' => '/penjwbpertanyaan',
                                    ),
                                    2 => 
                                    array (
                                        'type' => 'message',
                                        'label' => 'Persentase Mood',
                                        'text' => '/mood<spasi><nama>',
                                    ),
                                ),
                            ),
                            1 => 
                            array (
                                'title' => 'Fitur Hiburan',
                                'text' => 'Halaman 2',
                                'actions' => 
                                array (
                                    0 => 
                                    array (
                                        'type' => 'message',
                                        'label' => 'Mirip Siapa Dia?',
                                        'text' => '/miripsiapa<spasi><nama>',
                                    ),
                                    1 => 
                                    array (
                                        'type' => 'message',
                                        'label' => 'Keahlian',
                                        'text' => '/keahlian<spasi><nama>',
                                    ),
                                    2 => 
                                    array (
                                        'type' => 'message',
                                        'label' => 'Liburan',
                                        'text' => '/liburan<spasi><nama>',
                                    ),
                                ),
                            ),
                            2 => 
                            array (
                                'title' => 'Fitur Hiburan',
                                'text' => 'Halaman 3',
                                'actions' => 
                                array (
                                    0 => 
                                    array (
                                        'type' => 'message',
                                        'label' => 'Cek Status',
                                        'text' => '/status<spasi><nama>',
                                    ),
                                    1 => 
                                    array (
                                        'type' => 'message',
                                        'label' => 'Lacak Seseorang',
                                        'text' => '/keahlian<spasi><nama>',
                                    ),
                                    2 => 
                                    array (
                                        'type' => 'message',
                                        'label' => 'Cek Cita-cita',
                                        'text' => '/citacita<spasi><nama>',
                                    ),
                                ),
                            ),
                            3 => 
                            array (
                                'title' => 'Fitur Hiburan',
                                'text' => 'Halaman 4',
                                'actions' => 
                                array (
                                    0 => 
                                    array (
                                        'type' => 'message',
                                        'label' => 'Cek Aktifitas',
                                        'text' => '/aktifitas<spasi><nama>',
                                    ),
                                    1 => 
                                    array (
                                        'type' => 'message',
                                        'label' => 'Cek Tinggi Badan',
                                        'text' => '/tinggi<spasi><nama>',
                                    ),
                                    2 => 
                                    array (
                                        'type' => 'message',
                                        'label' => 'Cek Berat Badan',
                                        'text' => '/berat<spasi><nama>',
                                    ),
                                ),
                            ),
                            4 => 
                            array (
                                'title' => 'Fitur Hiburan',
                                'text' => 'Halaman 5',
                                'actions' => 
                                array (
                                    0 => 
                                    array (
                                        'type' => 'message',
                                        'label' => 'Cek Bentuk Tubuh',
                                        'text' => '/bntktubuh<spasi><nama>',
                                    ),
                                    1 => 
                                    array (
                                        'type' => 'message',
                                        'label' => 'Cek Nasib',
                                        'text' => '/nasib<spasi><nama>',
                                    ),
                                    2 => 
                                    array (
                                        'type' => 'message',
                                        'label' => 'Cek Hobi',
                                        'text' => '/hobi<spasi><nama>',
                                    ),
                                ),
                            ),
                        ),
                    ),
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == '/apakah') {
        $result = jawabs($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == '/mengapa') {
        $result = mengapa($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == '/kenapa') {
        $result = kenapa($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == '/kapan') {
        $result = kapan($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == '/dimana') {
        $result = dimana($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == '/mood') {
        $result = mood($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == '/miripsiapa') {
        $parsed = mirip($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array (
                    'type' => 'template',
                    'altText' => 'Mirip Siapakah Dia?',
                    'template' => 
                    array (
                        'type' => 'buttons',
                        'actions' => 
                        array (
                            0 => 
                            array (
                                'type' => 'message',
                                'label' => 'Ucapkan Selamat',
                                'text' => $options . ', Selamat ya. Muka mu emang pantes dengan dia...',
                            ),
                            1 => 
                            array (
                                'type' => 'uri',
                                'label' => 'Lihat Gambar',
                                'uri' => $parsed['pap'],
                            ),
                        ),
                        'text' => $parsed['info'],
                    ),
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == '/keahlian') {
        $parsed = ahli($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array (
                    'type' => 'template',
                    'altText' => 'Keahlian seseorang',
                    'template' => 
                    array (
                        'type' => 'buttons',
                        'actions' => 
                        array (
                            0 => 
                            array (
                                'type' => 'message',
                                'label' => 'Ucapkan Selamat',
                                'text' => $options . ', Selamat ya. Luar biasa keahlianmu...',
                            ),
                            1 => 
                            array (
                                'type' => 'uri',
                                'label' => 'Lihat Gambar',
                                'uri' => $parsed['pap'],
                            ),
                        ),
                        'text' => $parsed['info'],
                    ),
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == '/liburan') {
        $parsed = liburan($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array (
                    'type' => 'template',
                    'altText' => 'Liburan seseorang',
                    'template' => 
                    array (
                        'type' => 'buttons',
                        'actions' => 
                        array (
                            0 => 
                            array (
                                'type' => 'message',
                                'label' => 'Ucapkan Selamat',
                                'text' => 'Cie.. ' . $options . ' seneng pergi liburan',
                            ),
                            1 => 
                            array (
                                'type' => 'uri',
                                'label' => 'Lihat Gambar',
                                'uri' => $parsed['pap'],
                            ),
                        ),
                        'text' => $parsed['info'],
                    ),
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == '/status') {
        $result = status($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Status '. $options . ' Sekarang adalah ' . $result
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == '/lacak') {
        $result = lokasi($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $options . ' Sekarang lagi di ' . $result
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == '/citacita') {
        $result = cita($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Cita-cita '. $options . ' jadi ' . $result
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == '/aktifitas') {
        $result = aktifitas($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'aktifitas '. $options . ' Sekarang adalah ' . $result
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == '/tinggi') {
        $result = tinggi($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Tinggi '. $options . ' Sekarang adalah ' . $result
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == '/berat') {
        $result = berat($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Berat '. $options . ' Sekarang adalah ' . $result
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == '/bntktubuh') {
        $result = bentuktubuh($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Bentuk Tubuh '. $options . ' adalah ' . $result
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == '/nasib') {
        $result = nasib($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Nasib '. $options . ' Sekarang adalah ' . $result
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == '/hobi') {
        $result = hobi($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Hobi '. $options . ' adalah ' . $result
                )
            )
        );
    }
}
//=========ALAT===============
if($message['type']=='text') {
    if ($command == '/alat') {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array (
                    'type' => 'template',
                    'altText' => '[ FGM BOT ] Alat',
                    'template' => 
                    array (
                        'type' => 'buttons',
                        'actions' => 
                        array (
                            0 => 
                            array (
                                'type' => 'message',
                                'label' => 'Url ID Line',
                                'text' => '/idl<spasi><Id line>',
                            ),
                            1 => 
                            array (
                                'type' => 'message',
                                'label' => 'Url Chat WA',
                                'text' => '/chatwa',
                            ),
                            2 => 
                            array (
                                'type' => 'message',
                                'label' => 'Cek Profil IG',
                                'text' => '/ig<spasi><username>',
                            ),
                        ),
                        'title' => 'Fitur Alat',
                        'text' => 'Utilitas yang dapat memudahkan pekerjaan Anda',
                    ),
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == '/idl') {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'http://line.me/R/ti/p/~' . $options
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == '/linkwa') {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'https://api.whatsapp.com/send?phone=' . $options
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == '/ig') {
	$parsed = instainfo($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array (
                    'type' => 'template',
                    'altText' => 'Instagram Profile',
                    'template' => 
                    array (
                        'type' => 'buttons',
                        'actions' => 
                        array (
                            0 => 
                            array (
                                'type' => 'message',
                                'label' => 'Followers: ' . $parsed['followers'],
                                'text' => 'Itu Jumlah Pengikutnya',
                            ),
                            1 => 
                            array (
                                'type' => 'message',
                                'label' => 'Following: ' . $parsed['following'],
                                'text' => 'Itu Jumlah user yang dia ikuti',
                            ),
                            2 => 
                            array (
                                'type' => 'message',
                                'label' => 'Jumlah Post: ' . $parsed['totalpost'],
                                'text' => 'Itu Jumlah Postingannya',
                            ),
			    3 => 
                            array (
                                'type' => 'uri',
                                'label' => 'Kunjungi IG nya',
                                'uri' => $parsed['bawah'],
                            ),
                        ),
                        'thumbnailImageUrl' => $parsed['poto'],
                        'title' => 'Info Profil IG',
                        'text' => $parsed['nama'],
                    ),
                )
            )
        );
    }
}

if (isset($balas)) {
    $result = json_encode($balas);
//$result = ob_get_clean();
    file_put_contents('./balasan.json', $result);
    $client->replyMessage($balas);
}
?>
