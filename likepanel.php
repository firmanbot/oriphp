<?php
/*
just for fun
*/
require_once('./line_class.php');
require_once('./unirest-php-master/src/Unirest.php');
$channelAccessToken = 'T1XbFyfVbDVSqs4aORr3LvgpYlJEk6seyjn6ppTogdUR8J0Xcuq9IoZ+yxGQIERA4o2Q+CmLzHF/NMFAuc0VIZXpjbY2U2xMxx54qwG5mDZmvsYJTd60iHd1Q/60TKuz9g0GckAHlSAA2AUekNIKvAdB04t89/1O/w1cDnyilFU='; //sesuaikan
$channelSecret = '1816ed60d2e9bd8cae75b042180aae5a';//sesuaikan
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
$userId 	= $client->parseEvents()[0]['source']['userId'];
$groupId 	= $client->parseEvents()[0]['source']['groupId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$timestamp	= $client->parseEvents()[0]['timestamp'];
$type 		= $client->parseEvents()[0]['type'];
$message 	= $client->parseEvents()[0]['message'];
$messageid 	= $client->parseEvents()[0]['message']['id'];
$profil = $client->profil($userId);
$pesan_datang = explode("like", $message['text']);
//$pesan_datang1 = explode(" ", $message['text'])
$msg_type = $message['type'];
$command = $pesan_datang[0];
//$command1 = $pesan_datang1[0];
$options = $pesan_datang[1];

if (count($pesan_datang) > 2) {
    for ($i = 2; $i < count($pesan_datang); $i++) {
        $options .= '+';
        $options .= $pesan_datang[$i];
    }
}
#-------------------------[Function]-------------------------#
#-------------------------[Function]-------------------------#
# require_once('./src/function/search-1.php');
# require_once('./src/function/download.php');
# require_once('./src/function/random.php');
# require_once('./src/function/search-2.php');
# require_once('./src/function/hard.php');
if ($type == 'join') {
    $text = "Thx telah di undang ke grup. ketik like ya...\n\nLINE LIKE PANEL. Present By CF Virtual Bots\n\nTeam Support\n# FGM Bots\n#HTB TeamBot";
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
//======================Fitur hiburan================================
if($message['type']=='text') {
    if ($command == 'S1') {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Like sedang di proses... Jika tidak mau masuk disebabkan limit submit 2-3 menit atau token habis'
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == 'S2') {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Like sedang di proses... Jika tidak mau masuk disebabkan limit submit 2-3 menit atau token habis'
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == 'S3') {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Like sedang di proses... Jika tidak mau masuk disebabkan limit submit 2-3 menit atau token habis'
                )
            )
        );
    }
}
if($message['type']=='text') {
    if ($command == 'S4') {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Like sedang di proses... Jika tidak mau masuk disebabkan limit submit 2-3 menit atau token habis'
                )
            )
        );
    }
}
//if($message['type']=='text') {
//    if ($command1 == 'likepost') {
//        $balas = array(
//            'replyToken' => $replyToken,
//            'messages' => array(
//                array(
//                   'type' => 'text',
//                    'text' => 'Silahkan kirim postnya kaka...'
//                )
//            )
//        );
//    }
//}
if (isset($balas)) {
    $result = json_encode($balas);
//$result = ob_get_clean();
    file_put_contents('./balasan.json', $result);
    $client->replyMessage($balas);
}
?>
