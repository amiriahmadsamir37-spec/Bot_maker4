<?php
$stepadmin = file_get_contents("step.txt");
if (in_array($chat_id , $admin)) {
if ($textmessage == 'پنل' or $textmessage == '▫️برگشت▫️' or $textmessage == '/panel') {
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"هلو ادمین",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔸 آمار 🔸"],['text'=>"📢 تنظیم کانال 📢"]],
[['text'=>"🔸 فورواد همگانی 🔸"]],
[['text'=>"🔸 ارسال همگانی 🔸"] , ['text'=>"🔹 برگشت 🔹"]],
[['text'=>"باقی مانده اشتراک ❗️"]],
],
"resize_keyboard"=>true,
])
]);
}
if ($textmessage == '🔸 آمار 🔸') {
$user = file_get_contents("members.txt");
$member_id = explode("\n",$user);
$countm = count($member_id) -1;
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"آمار ربات شما تا این لحظه $countm",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔸 آمار 🔸"],['text'=>"📢 تنظیم کانال 📢"]],
[['text'=>"🔸 فورواد همگانی 🔸"]],
[['text'=>"🔸 ارسال همگانی 🔸"] , ['text'=>"🔹 برگشت 🔹"]],
[['text'=>"باقی مانده اشتراک ❗️"]],
],
"resize_keyboard"=>true,
])
]);
}
if ($textmessage == 'باقی مانده اشتراک ❗️') {
$user = file_get_contents("members.txt");
$member_id = explode("\n",$user);
$countm = count($member_id) -1;
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"تا پایان اشتراک شما $day روز باقی مانده است ✅",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔸 آمار 🔸"],['text'=>"📢 تنظیم کانال 📢"]],
[['text'=>"🔸 فورواد همگانی 🔸"]],
[['text'=>"🔸 ارسال همگانی 🔸"] , ['text'=>"🔹 برگشت 🔹"]],
[['text'=>"باقی مانده اشتراک ❗️"]],
],
"resize_keyboard"=>true,
])
]);
}
if ($textmessage == '🔸 فورواد همگانی 🔸') {
file_put_contents("step.txt" , "fwd");
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"پیام خود را فوروارد کنید ",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"▫️برگشت▫️"]],
],
"resize_keyboard"=>true,
])
]);
}
if ($stepadmin == "fwd" and $textmessage != "▫️برگشت▫️") {
file_put_contents("step.txt" , "none");
$all_member = fopen( "members.txt", "r");
while( !feof( $all_member)) {
$user = fgets( $all_member);
$id = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getChat?chat_id=".$user));
$user2 = $id->result->id;
if($user2 != null){
bot('ForwardMessage',[
'chat_id'=>$user,
'from_chat_id'=>$chat_id,
'message_id'=>$message_id
]);
}
}
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"اوکی شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔸 آمار 🔸"],['text'=>"📢 تنظیم کانال 📢"]],
[['text'=>"🔸 فورواد همگانی 🔸"]],
[['text'=>"🔸 ارسال همگانی 🔸"] , ['text'=>"🔹 برگشت 🔹"]],
[['text'=>"باقی مانده اشتراک ❗️"]],
],
"resize_keyboard"=>true,
])
]);
}
if ($textmessage == '🔸 ارسال همگانی 🔸') {
file_put_contents("step.txt" , "snd");
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"پیام خود را بفرستید  ",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"▫️برگشت▫️"]],
],
"resize_keyboard"=>true,
])
]);
}
if ($textmessage == '📢 تنظیم کانال 📢') {
file_put_contents("step.txt" , "setch");
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"آیدی کانال خود را بدون @ ارسال کنید 
توجه کنید ک قبل از ارسال حتما ربات را داخل کانال ادمین کرده و خود نیز داخل کانال عضو باشید ⚠️
در صورتی هم ک تمایل ب حذف کانال جویین اجباری دارید عدد 0 را ارسال کنید 🙏🏽",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"▫️برگشت▫️"]],
],
"resize_keyboard"=>true,
])
]);
}
if ($stepadmin == "setch" and $textmessage != "▫️برگشت▫️") {
file_put_contents("step.txt" , "none");
if ($textmessage == '0') {
unlink("channel.txt");
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"کانال جویین اجباری حذف شد ❌",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"▫️برگشت▫️"]],
],
"resize_keyboard"=>true,
])
]);
}else{
file_put_contents("channel.txt" , "$textmessage");
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"کانال @$textmessage با موفقیت ب عنوان کانال جویین اجباری ثبت شد ✅",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"▫️برگشت▫️"]],
],
"resize_keyboard"=>true,
])
]);
}}
if ($stepadmin == "snd" and $textmessage != "▫️برگشت▫️") {
file_put_contents("step.txt" , "none");
$all_member = fopen( "members.txt", 'r');
while( !feof( $all_member)) {
$user = fgets( $all_member);
$id = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getChat?chat_id=".$user));
$user2 = $id->result->id;
if($user2 != null){
if($textmessage != null){
bot('sendMessage', [
'chat_id' =>$user,
'text' =>$textmessage,
'parse_mode' =>"html",
'disable_web_page_preview' =>"true"
]);
}
}
}
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"اوکی شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔸 آمار 🔸"],['text'=>"📢 تنظیم کانال 📢"]],
[['text'=>"🔸 فورواد همگانی 🔸"]],
[['text'=>"🔸 ارسال همگانی 🔸"] , ['text'=>"🔹 برگشت 🔹"]],
[['text'=>"باقی مانده اشتراک ❗️"]],
],
"resize_keyboard"=>true,
])
]);
}














}