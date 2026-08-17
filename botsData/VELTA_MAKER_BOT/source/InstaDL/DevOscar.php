<?php
//ارتقا دهنده دیباگ کننده سورس @HOKOMAT_ARAB
//اولین چنل اوپن کننده @noori_team_810

//----------
date_default_timezone_set('Asia/Tehran');
include 'config.php';
$day = (2505600 - (time() - filectime('Mahdy'))) / 60 / 60 / 24;
$day = round($day, 0);
//----------
if ($day <= 2){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"ادمین گرامی مدت زمان اشتراک شما در رباتساز بزرگ ما ب اتمام رسیده است ⚠️
برای تمدید ربات خود به پیوی ادمین مراجعه کنید ❤️",
'parse_mode'=>'MarkDown',
]);
exit();
}
if($tch1 != "member" && $tch1 != "creator" && $tch1 != "administrator" or $tch2 != "member" && $tch2 != "creator" && $tch2 != "administrator"){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
🌟 برای حمایت در کانال ما عضو شوید
", 
'reply_markup'=>$join
]);
}
elseif(preg_match('/^\/(start)$/i', $text) or $text == 'بازگشت 🔙' or $text == '/cancel'){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
bot('sendmessage',[
'chat_id' => $chat_id,
'text' => "$starttxt",
'parse_mode' => "html",
'reply_markup' => $home
]);
}
elseif($text == '🔰 راهنما'){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
$outjson = json_encode($user,true);
bot('sendmessage',[
'chat_id' => $chat_id,
'text' => "*
🚧 راهنمای کلی:
• برای استفاده از ربات بدونه هیچگونه مشکل، لطفا با صبر و ملاحظه قابلیت های آن را مورد استفاده قرار دهید !

🔻 راهنمای اینستاگرام:
۱- بخش پست به راحتی پست را دانلود خواهد کرد؛ اما توجه داشته باشید که پس از اتمام دانلود پست های خود، حتما دستور [ بازگشت 🔙 ] و یا [ /cancel ] را ارسال کنید !
۲- بخش استوری گاهی اوقات با مشکل سرور مواجه خواهد بود؛ پس توجه داشته باشید که اگر ربات پاسخ درستی برای شما ارسال نکرد میتواند به دو دلیل باشد:
یک: آیدی پیج مورد نظر اشتباه می باشد!
دو: سرور با کندی مواجه است!
اگر آیدی را چک کردید و اشتباه نبود، مجددا آیدی پیج را برای ربات ارسال نمایید، بار بعد حتما پاسخ دریافت خواهید کرد !

🎗️ راهنمای آپارات:
• گاهی اوقات کندی سرور مشکل ساز دانلود پست شما خواهد بود، اما حتما پس از چند دقیقه صبر ربات پاسخ درستی برای شما ارسال خواهد کرد. پس برای این امر صبور باشید !*
",
'parse_mode' => "MarkDown",
]);
}
elseif($text == 'پشتیبانی 👨🏻‍💻'){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
$outjson = json_encode($user,true);
bot('sendmessage',[
'chat_id' => $chat_id,
'text' => "اگر مشکلی در ربات بوجود اومد اطلاع بدید: @$supp 🌷",
'parse_mode' => "html",
'reply_markup' => $home
]);
}
/*elseif($text == '/creator'){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
$outjson = json_encode($user,true);
bot('sendmessage',[
'chat_id' => $chat_id,
'text' => "@HOKOMAT_ARAB",
'parse_mode' => "html",
'reply_markup' => $home
]);
}*/
elseif($text == 'هایلایت ❗️'){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
$outjson = json_encode($user,true);
bot('sendmessage',[
'chat_id' => $chat_id,
'text' => "بزودی...!",
'parse_mode' => "MarkDown",
'reply_markup' => $instagram
]);
}
elseif($text == '🔲 بخش موزیک'){
$user["step"] = "music";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
$outjson = json_encode($user,true);
bot('sendmessage',[
'chat_id' => $chat_id,
'text' => "لطفا اسم اهنگ یا خواننده را وارد نمایید،",
'parse_mode' => "MarkDown",
'reply_markup' => $back
]);
}
elseif($user['step']== "music" and $text != 'بازگشت 🔙' and $text != '/start' and $text != '/cancel'){ 
$get = file_get_contents("https://sidepath.ga/api/nextone.php?url=$text");
$ret=json_decode($get,true);
for($X=0;$X<=count($ret['Results'])-1;$X++){
$tag = $ret['Results'][$X]['tag'];
$code = $ret['Results'][$X]['dl_asli'];
$code2 = $ret['Results'][$X]['dl_128'];
$kobs .= "
=-=-=-=-=-=-=-=-=-=-=-=-=-= 
🥇نام = $tag
کیفیت اصلی  =
$code
کیفیت 128 =
$code2";
}
bot('sendmessage',[
'chat_id' => $chat_id,
'text' => "$kobs",
'parse_mode' => "html",
'reply_markup' => $home
]);
}
elseif($text == '▪️ بخش اینستاگرام'){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
$outjson = json_encode($user,true);
bot('sendmessage',[
'chat_id' => $chat_id,
'text' => "*انتخاب کنید !*",
'parse_mode' => "MarkDown",
'reply_markup' => $instagram
    ]);
}
//post
elseif($text == 'عکس 📝' or $text == 'کلیپ 🔗'){
$user["step"] = "post";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
$outjson = json_encode($user,true);
bot('sendmessage',[
'chat_id' => $chat_id,
'text' => "*لینک پست مورد نظر را ارسال کنید !❤️
توجه کنید که حتما لینک عکس و یا فیلم باشد مگرنه ربات چیزی برای شما ارسال نخواهد کرد ⚠️*",
'parse_mode' => "MarkDown",
'reply_markup' => $back
]);
}
// @Mr_Hawck
elseif($user['step']== "post" and $text != 'بازگشت 🔙' and $text != '/start' and $text != '/cancel'){
$api = json_decode(file_get_contents("https://mehdikiing.cptele.ir/api/insta.php?type=post&url=$text"),true);
bot('deletemessage',[
'chat_id' => $chat_id,
'message_id' => $message_id
]);
bot('sendmessage',[
'chat_id' => $chat_id,
'text' => "[مشاهده پست شما در اینستاگرام ♻️]($text)",
'parse_mode' => "MarkDown"
]);
$result = $api['Results'];
for($i=0;$i<count($result);$i++){
$post = $result[$i]['post'];
$caption = $result[$i]['caption'];
$type = $result[$i]['type'];
if($type == 'jpg'){
bot('senddocument',[
'chat_id' => $chat_id,
'document' => $post,
'caption' => "*دریافت شد ! ♻️*",
'parse_mode' => "MarkDown",
'reply_markup' => $back
]);
}
if($type == 'mp4'){
bot('sendvideo',[
'chat_id' => $chat_id,
'video' => $post,
'caption' => "*دریافت شد ! ♻️*",
'parse_mode' => "MarkDown",
'reply_markup' => $back
]);
}
}
bot('sendmessage',[
'chat_id' => $chat_id,
'text' => "محتویات پست مورد نظر دریافت شد ! ♻️
💬 کپشن:
`$caption`",
'parse_mode' => "MarkDown"
]);
}
//story
elseif($text == 'استوری ❕' or $text == '/story'){
$user["step"] = "story2";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
$outjson = json_encode($user,true);
bot('sendmessage',[
'chat_id' => $chat_id,
'text' => "*شما در حال دانلود استوری می باشید !\nیوزرنیم مورد نظر را ارسال کنید !*",
'parse_mode' => "MarkDown",
'reply_markup' => $Servers
]);
}
elseif($user['step']== "story2" and $text != 'بازگشت 🔙' and $text != '/start' and $text != '/cancel'){
$api = json_decode(file_get_contents("https://mehdikiing.cptele.ir/api/instanew.php?type=story&url=$text"),true);
bot('deletemessage',[
'chat_id' => $chat_id,
'message_id' => $message_id
]);
bot('sendmessage',[
'chat_id' => $chat_id,
'text' => "[اینستاگرام ♻️](https://instagram.com/$text)",
'parse_mode' => "MarkDown"
]);
$result = $api['Results'];
$count = $api['count'];
bot('sendmessage',[
'chat_id' => $chat_id,
'text' => "*تعداد استوری دریافت شده : $count ♻️*",
'parse_mode' => "MarkDown"
]);
for($i=0;$i<$count;$i++){
$story = $result[$i]['story'];
bot('senddocument',[
'chat_id' => $chat_id,
'document' => $story,
'caption' => "*دریافت شد ! ♻️*",
'parse_mode' => "MarkDown",
'reply_markup' => $back
]);
}
}
//aparat
//--------------admin panel
//--------------@HOKOMAT_ARAB
elseif($chat_id == $config['admin'] and $text == '/panel'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"خوش اومدی نفصم",
'parse_mode'=>"MarkDown",
'reply_markup' => $adpanel
    ]); 
}
elseif($text == "باقی مانده اشتراک ❗️"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"تا پایان اشتراک شما $day روز باقی مانده است ✅",
'parse_mode'=>'MarkDown',
'reply_markup'=>$adpanel
]); 
}
//----------
elseif($chat_id == $config['admin'] and $text == 'آمار ربات 📊'){	
$alluser = file_get_contents("data/members.txt");
$alaki = explode("\n",$alluser);
$allusers = count($alaki)-1;
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🧍‍♂️ *$allusers*",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$message_id,
'reply_markup' => $adpanel
]); 
}
//----------
elseif($text == 'ارسال همگانی 📭' && $from_id == $config['admin']){	
$user["step"] = "send2all";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
$outjson = json_encode($user,true);
bot('sendMessage',[
'chat_id'=>$config['admin'],
'text'=>"*پیام مورد نظر را ارسال کنید ! ♻️*",
'parse_mode'=>"MarkDown",
'reply_markup' => $back
]);
}
// @Mr_Hawck
elseif($chat_id == $config['admin'] && $user['step']== "send2all" && $text != "بازگشت 🔙" && $text != '/start' && $text != '/cancel'){ 
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
$outjson = json_encode($user,true);
$all_member = fopen( "data/members.txt", 'r');
while( !feof( $all_member)) {
$user = fgets( $all_member);
bot('sendMessage',[
'chat_id'=>$user,
'text'=>$text,
'parse_mode'=>"MarkDown",
]);
}
bot('sendMessage',[
'chat_id'=>$config['admin'],
'text'=>"*ارسال شد !*",
'parse_mode'=>"MarkDown",
'reply_markup' => $adpanel
]);
}
//----------
elseif($text == 'بخش کانال ها ⚙️' && $from_id == $config['admin']){	
bot('sendMessage',[
'chat_id'=>$config['admin'],
'text'=>"به بخش تنظیمات کانال ها خوش امدید ♥️",
'parse_mode'=>"MarkDown",
'reply_markup' => $setch
]);
}
elseif($text == 'تنظیم کانال اول ❗️' && $from_id == $config['admin']){	
$user["step"] = "setch1";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
$outjson = json_encode($user,true);
bot('sendMessage',[
'chat_id'=>$config['admin'],
'text'=>"ایدی کانال خود را بدون @ ارسال کنید 
نمونه 
MrHawck",
'parse_mode'=>"MarkDown",
'reply_markup' => $back
    ]);
}
elseif($text != "بازگشت 🔙" && $text != '/start' && $text != '/cancel' && $from_id == $config['admin'] && $user['step']== "setch1"){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
$outjson = json_encode($user,true);
file_put_contents("canal1.txt",$text);
bot('sendMessage',[
'chat_id'=>$config['admin'],
'text'=>"کانال اول با موفقیت تنظیم شد ✅",
'parse_mode'=>"MarkDown",
'reply_markup' => $adpanel
]);
}
elseif($text == 'تنظیم کانال دوم ❗️' && $from_id == $config['admin']){	
$user["step"] = "setch2";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
$outjson = json_encode($user,true);
bot('sendMessage',[
'chat_id'=>$config['admin'],
'text'=>"ایدی کانال خود را بدون @ ارسال کنید 
نمونه 
Mr_Hawck",
'parse_mode'=>"MarkDown",
'reply_markup' => $back
]);
}
elseif($text != "بازگشت 🔙" && $text != '/start' && $text != '/cancel' && $from_id == $config['admin'] && $user['step']== "setch2"){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
$outjson = json_encode($user,true);
file_put_contents("canal2.txt",$text);
bot('sendMessage',[
'chat_id'=>$config['admin'],
'text'=>"کانال دوم با موفقیت تنظیم شد ✅",
'parse_mode'=>"MarkDown",
'reply_markup' => $adpanel
]);
}
//----------
elseif($chat_id == $config['admin'] and $text == 'فوروارد همگانی 📫'){
$user["step"] = "f2all";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
$outjson = json_encode($user,true);
bot('sendMessage',[
'chat_id'=>$config['admin'],
'text'=>"*فروارد کنید ! ♻️*",
'parse_mode'=>"MarkDown",
'reply_markup' => $back
]); 
}
elseif($text != "بازگشت 🔙" && $text != '/start' && $text != '/cancel' && $from_id == $config['admin'] && $user['step']== "f2all"){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
$outjson = json_encode($user,true);
$all_member = fopen( "data/members.txt", 'r');
while( !feof( $all_member)) {
$user = fgets( $all_member);
bot('ForwardMessage',[
'chat_id'=>$user,
'from_chat_id'=>$config['admin'],
'message_id'=>$message_id
]);
}    
bot('sendMessage',[
'chat_id'=>$config['admin'],
'text'=>"*فروارد شد ! ♻️*",
'parse_mode'=>"MarkDown",
'reply_markup' => $adpanel
]);
}
unlink('error_log');
//ارتقا دهنده دیباگ کننده سورس @HOKOMAT_ARAB
//اولین چنل اوپن کننده @noori_team_810

?>