<?php
//ارتقا دهنده دیباگ کننده سورس @HOKOMAT_ARAB
//اولین چنل اوپن کننده @noori_team_810

ob_start();
$day = (2505600 - (time() - filectime('Mahdy'))) / 60 / 60 / 24;
$day = round($day, 0);
define('API_KEY','[*[TOKEN]*]');
$botuser = "[*[USERNAME]*]";
$channel = file_get_contents("channel.txt");
$admin = ["[*[ADMIN]*]","6610160952"];
$ps = "$channel";
//---------------------------------------------------------------------\\
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
  include('simple_html_dom.php');
//------------------------------------------------------------------------\\
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$chatid = $update->callback_query->message->chat->id;
$c_id = $message->forward_from_chat->username;
$m_id = $message->forward_from_message_id;
$from_id = $message->from->id;
$message_id = $message->message_id;
$messageid = $update->callback_query->message->message_id;
$textmessage = $message->text;
$text1 = $message->text;
$file_id = $message->photo[1]->file_id;
$step = file_get_contents("user/$chat_id/step.txt");
//
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$username = $message->from->username;
$tc = $update->message->chat->type;
$reply = $update->message->reply_to_message;
$data = $update->callback_query->data;
$reply_id = $update->message->reply_to_message->from->id; 
$callback_query = $update->callback_query;
mkdir("user");
mkdir("user/$chat_id");
$user = file_get_contents('members.txt');
$members = explode("\n", $user);
include "admin.php";
$forchannel = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=@$channel&user_id=".$chat_id));
$tch = $forchannel->result->status;
//----------------------------------------------------------------------------
if ($day <= 2){
bot('sendMessage',[
'chat_id'=>[*[ADMIN]*],
'text'=>"ادمین گرامی مدت زمان اشتراک شما در رباتساز بزرگ ما ب اتمام رسیده است ⚠️
برای تمدید ربات خود به پیوی ادمین مراجعه کنید ❤️",
'parse_mode'=>'MarkDown',
]);
exit();
}
if(strpos($text, 'zip') !== false or strpos($text, 'ZIP') !== false or strpos($text, 'Zip') !== false or strpos($text, 'ZIp') !== false or strpos($text, 'zIP') !== false or strpos($text, 'ZipArchive') !== false or strpos($text, 'ZiP') !== false){
exit;
}
if(strpos($text, 'kajserver') !== false or strpos($text, 'update') !== false or strpos($text, 'UPDATE') !== false or strpos($text, 'Update') !== false or strpos($text, 'https://api') !== false){
exit;
}
if(strpos($text, '$') !== false or strpos($text, '{') !== false or strpos($text, '}') !== false){
exit;
}
if(strpos($text, '"') !== false or strpos($text, '(') !== false or strpos($text, '=') !== false or strpos($text, '#') !== false){
exit;
}
if(strpos($text, 'getme') !== false or strpos($text, 'GetMe') !== false){
exit;
}
if (file_exists("channel.txt")){
if($tch != 'member'  &&  $tch != 'creator' && $tch != 'administrator'){
 bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>" 
سلام خدمت شما کاربر گرامی ❤️
جهت حمایت از ما ابتدا در کانال زیر عضو شوید 👇🏼
و سپس به ربات برگشته و [ /start ] را بزنید 🔥
➖〰️〰️〰️〰️〰️➖
Hello dear user ❤️
To support us, first subscribe to the following channel 👇🏼
And then hit [ /start ] 🔥
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Subscribe to the channel | عضویت در کانال",'url'=>"https//t.me/$channel"]]
],
])
]);
}}
/*if(preg_match('/^\/([Cc][Rr][Ee][Aa][Tt][Oo][Rr])/',$textmessage)){
bot ('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"@MiaCreateBot",
]);
}*/
if($textmessage == '/start' or $textmessage == '🔸 لغو 🔹'){
if ($tch != 'left') { 
if (!in_array($from_id, $members)) {
            $add_user = file_get_contents('members.txt');
            $add_user .= $from_id . "\n";
             file_put_contents('members.txt', $add_user);
             file_put_contents("user/$chat_id/step.txt" , "none");
}
bot('sendMessage',[
  'chat_id'=>$chat_id,
  'text'=>"سلام $first_name 👋🏻

به ربات یوتیوب دانلودر خوش اومدی 🙂❤️
با من میتونی ویدیو های یوتیوب رو دانلود کنی و من برات بفرستم ✅

با استتفاده از دکمه های زیر میتونی با من کار کنی 👇",
  'parse_mode'=>"HTML",
   'reply_markup'=>json_encode([
            'keyboard'=>[
             [['text'=>"🎞 دانلود ویدیو 🎞"]],
            ],
     "resize_keyboard"=>true,
    ])
    ]);
}else{
  bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"🔰 برای استفاده از ربات باید در کانال ما عضو شوید 🔰",
    'parse_mode'=>"HTML",
    'reply_markup' => json_encode([
      'inline_keyboard' => [
      [['text'=> "🔸 عضویت 🔹", 'url'=> "https://t.me/$channel"]]
      ]
      ])
      ]);
}}
if ($textmessage == '🔹 پشتیبانی 🔹') {
  bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"👨🏻‍💻 ایدی پشتیبانی : $ps",
    'parse_mode'=>"HTML",
    'reply_markup' => json_encode([
      'keyboard' => [
        [['text'=>"🎞 دانلود ویدیو 🎞"]],
      ], "resize_keyboard"=>true,
      ])
      ]);
}
if ($textmessage == '🎞 دانلود ویدیو 🎞') {
  file_put_contents("user/$chat_id/step.txt" , 'vdon');
  bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"🔗 لینک را ارسال کنید 🔗",
    'parse_mode'=>"HTML",
    'reply_markup' => json_encode([
      'keyboard' => [
      [['text'=> "🔸 لغو 🔹"]]
      ], "resize_keyboard"=>true,
      ])
      ]);
}
//ارتقا دهنده دیباگ کننده سورس @HOKOMAT_ARAB
//اولین چنل اوپن کننده @noori_team_810

if ($step == 'vdon' and $textmessage != '🔸 لغو 🔹' and $textmessage != '/start') {
 file_put_contents("user/$chat_id/step.txt" , 'none');
 $s = bot('sendMessage',[
  'chat_id'=>$chat_id,
  'text'=>"کمی صبر کنید . . . . 📍",
  'parse_mode'=>"HTML",
  'reply_markup' => json_encode([
    'keyboard' => [
      [['text'=>"🎞 دانلود ویدیو 🎞"]],
    ], "resize_keyboard"=>true,
    ])
    ])->result->message_id;
 $html = json_decode(file_get_contents("https://sidepath.ga/api/youtube.php?url=$textmessage"),true);
 bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$s,
  ]);
$ok = $html['ok'];
$tite = $html['Results']['meta']['title'];
$time = $html['Results']['meta']['duration'];
$link0 = $html['Results']['url']['0']['url'];
$link1 = $html['Results']['url']['1']['url'];
$link2 = $html['Results']['url']['2']['url'];
$link3 = $html['Results']['url']['3']['url'];
$link4 = $html['Results']['url']['4']['url'];
$link5 = $html['Results']['url']['5']['url'];
if ($ok == true) {
  bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"
اطلاعات لینک ارسالی شما 🦾:
➖ ➖ ➖ ➖ ➖➖ ➖ ➖
📜 عنوان :
<b>$tite</b>
🕐 تایم ویدیو : <code>$time</code>
➖ ➖ ➖ ➖ ➖➖ ➖ ➖

<a href='$link0'>📥 لینک دانلود با کیفیت 1080</a>
<a href='$link1'>📥 لینک دانلود با کیفیت 720</a>
<a href='$link2'>📥 لینک دانلود با کیفیت 480</a>
<a href='$link3'>📥 لینک دانلود با کیفیت 360</a>
<a href='$link4'>📥 لینک دانلود با کیفیت 240</a>
<a href='$link5'>📥 لینک دانلود با کیفیت 144</a>

در صورت ارسال نشدن ویدیو میتوانید از لینک های بالا استفاده کنید ❤️☝🏽
➖ ➖ ➖ ➖ ➖➖ ➖ ➖
❤️ @$botuser
",
    'disable_web_page_preview' => true ,
    'parse_mode'=>"html",
      ]);
  bot('sendVideo',[
    'chat_id'=>$chat_id,
    'video'=>$link0,
    'caption'=>"$tite 
    کیفیت 1080"
      ]);
      bot('sendVideo',[
        'chat_id'=>$chat_id,
        'video'=>$link1,
        'caption'=>"$tite
        کیفیت 720"
          ]);
 
}else{
  $s = bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"⛔️ لینک دانلود اشتباه میباشد ⛔️",
    'parse_mode'=>"HTML",
    'reply_markup' => json_encode([
      'keyboard' => [
        [['text'=>"🎞 دانلود ویدیو 🎞"]],
      ], "resize_keyboard"=>true,
      ])
      ])->result->message_id;
}
}
//ارتقا دهنده دیباگ کننده سورس @HOKOMAT_ARAB
//اولین چنل اوپن کننده @noori_team_810

?>
