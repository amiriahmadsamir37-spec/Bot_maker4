<?php
//config
$kanal1 = file_get_contents("canal1.txt");
$kanal2 = file_get_contents("canal2.txt");
$config = [
    'token' => "[*[TOKEN]*]", //توکن
    'channel' => "$kanal1",
    'channel2' => "$kanal2",
    'admin' => "[*[ADMIN]*]" //ایدی عددی ادمین
];
$supp = "[*[CHANNEL]*]"; //ایدی پشتیبانی بدون @
$starttxt = "سلام ب ربات اینستا دانلودر ما خوش اومدی ❤️
از پنل زیر برای دانلود استفاده کن 👇🏽"; // متن استارت ربات 
//----------
//از اینجا ب بعد دس نزنید
//----------
define('API_KEY',$config['token']);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
function EditMessageText($chat_id,$message_id,$text,$parse_mode,$disable_web_page_preview,$keyboard){
    bot('editMessagetext',[
        'chat_id'=>$chat_id,
        'message_id'=>$message_id,
        'text'=>$text,
        'parse_mode'=>$parse_mode,
        'disable_web_page_preview'=>$disable_web_page_preview,
        'reply_markup'=>$keyboard
]);
}
function Forward($berekoja,$azchejaei,$kodompayam)
{
    bot('ForwardMessage',[
        'chat_id'=>$berekoja,
        'from_chat_id'=>$azchejaei,
        'message_id'=>$kodompayam
]);
}
function Zip($fzip, $zips){
    $rootPath = realpath($fzip);
    $zip = new ZipArchive();
    $zip->open($zips, ZipArchive::CREATE | ZipArchive::OVERWRITE);
    $files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY);
    foreach($files as $name => $file){
        if(!$file->isDir()){
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($rootPath) + 1);
            $zip->addFile($filePath, $relativePath);}}
            $zip->close();
}
function SendDocument($chat_id, $document, $caption = null){
    bot('SendDocument',[
        'chat_id'=>$chat_id,
        'document'=>$document,
        'caption'=>$caption
    ]);
}
//----------
$home = json_encode(['keyboard' => [
    [['text' => '▪️ بخش اینستاگرام']],
    [['text' => '🔲 بخش موزیک']],
    [['text' => 'پشتیبانی 👨🏻‍💻'],['text' => '🔰 راهنما']]
], 'resize_keyboard' => true, 'input_field_placeholder' => 'Main Menu !'
]);
$instagram = json_encode(['keyboard' => [
    [['text' => 'استوری ❕'],['text' => 'هایلایت ❗️']],
	[['text' => 'عکس 📝'],['text' => 'کلیپ 🔗']],
    [['text' => 'بازگشت 🔙']],
], 'resize_keyboard' => true, 'input_field_placeholder' => 'Instagram !'
]);
$back = json_encode(['keyboard' => [
    [['text' => 'بازگشت 🔙']],
], 'resize_keyboard' => true, 'input_field_placeholder' => 'Send Command !'
]);
$join = json_encode(['inline_keyboard' => [
    [['text' => 'عضویت ✅', 'url' => 'https://t.me/'.$config['channel']]],
    [['text' => 'عضویت ✅', 'url' => 'https://t.me/'.$config['channel2']]]
]
]);
$adpanel = json_encode(['keyboard' => [
    [['text' => 'آمار ربات 📊']],
    [['text' => 'ارسال همگانی 📭'],['text' => 'فوروارد همگانی 📫']],
	[['text' => 'بخش کانال ها ⚙️']],
	[['text' => 'باقی مانده اشتراک ❗️']]
], 'resize_keyboard' => true, 'input_field_placeholder' => '@MiaCreateBot'
]);
$setch = json_encode(['keyboard' => [
    [['text' => 'تنظیم کانال اول ❗️']],
    [['text' => 'تنظیم کانال دوم ❗️']],
	[['text' => 'بازگشت 🔙']],
], 'resize_keyboard' => true
]);
//----------
$update = json_decode(file_get_contents("php://input"));
$message = $update->message;
$text = $message->text;
$textt = $message->text;
$from_id = $message->from->id;
$fromid = $update->callback_query->from->id;
$chat_id = $message->chat->id;
$chatid = $update->callback_query->message->chat->id;
$message_id = $message->message_id;
$messageid = $update->callback_query->message->message_id;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$first = $update->callback_query->from->first_name;
$username = $message->from->username;
$tc = $update->message->chat->type;
$data = $update->callback_query->data;
$reply = $message->reply_to_message->forward_from->id;
$reply_id = $message->reply_to_message->from->id;
@mkdir("data");
@mkdir("data/$from_id");
$user = json_decode(file_get_contents("data/$from_id.json"),true);
$step = $user["step"];
$new_chat_member = $message->new_chat_member;
$new_chat_member_id = $new_chat_member->id;
$new_chat_member_first_name = $new_chat_member->first_name;
$new_chat_member_last_name = $new_chat_member->last_name;
$new_chat_member_username = $new_chat_member->username;
$stat = file_get_contents("data/stat.txt");

$amar=file_get_contents("data/members.txt");
$exp=explode("\n",$amar);

if(!in_array($from_id,$exp) && $from_id != $id){
    $myfile2 = fopen("data/members.txt", "a") or die("Unable to open file!");
    fwrite($myfile2, "$from_id\n");
    fclose($myfile2);
}

@$member = json_decode(file_get_contents('member.json'), true);
@$user = json_decode(file_get_contents("data/$from_id/$from_id.json"),true);
@$step = $user['step'];
$member = file_get_contents("data/members.txt");
$remove = json_encode(['KeyboardRemove'=>[],'remove_keyboard'=>true]);
//----------
$truechannel = json_decode(file_get_contents("https://api.telegram.org/bot".$config['token']."/getChatMember?chat_id=@".$config['channel']."&user_id=".$from_id));
$tch1 = $truechannel->result->status;
$truechannel1 = json_decode(file_get_contents("https://api.telegram.org/bot".$config['token']."/getChatMember?chat_id=@".$config['channel2']."&user_id=".$from_id));
$tch2 = $truechannel1->result->status;
?>