<?php
//ارتقا دهنده دیباگ کننده سورس @HOKOMAT_ARAB
//اولین چنل اوپن کننده @noori_team_810

error_reporting(~E_ALL);
$day = (2505600 - (time() - filectime('Mahdy'))) / 60 / 60 / 24;
$day = round($day, 0);
define('API_KEY',"[*[TOKEN]*]");
function Bot($method, $datas=[]){
$ch = curl_init();
curl_setopt_array($ch, [
CURLOPT_URL => 'https://api.telegram.org/bot'.API_KEY.'/'.$method,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_POST => true,
CURLOPT_POSTFIELDS => $datas
]);
$res = json_decode(curl_exec($ch), true);
return $res;
curl_close($ch);
}
function sm($ci, $msg, $rep=null, $key=null){
Bot('SendMessage',[
'chat_id'=> $ci,
'text'=> $msg,
'reply_to_message_id'=> $rep,
'reply_markup'=> $key
]);
}
function edit($ci, $msg_id, $text){
Bot('EditMessageText',[
'chat_id'=> $ci,
'message_id'=> $msg_id,
'text'=> $text,
'parse_mode'=> 'HTML'
]);
}
function alert($callback_query_id,$text,$show_alert=false){
Bot('answerCallbackQuery',[
'callback_query_id'=>$callback_query_id,
'text'=>$text,
'show_alert'=>$show_alert
]);
}
function save($dir, $data){
$f = fopen($dir,"a");
fwrite($f, $data);
fclose($f);
}
function put($dir, $data){
file_put_contents($dir, $data);
}
function get($from){
return Bot('GetChat',['chat_id'=> $from]);
}
$keyHome = json_encode([
'keyboard'=> [
[['text'=> "📝 گزاشتن پست"]]
],'resize_keyboard'=> true
]);
$keyBack = json_encode([
'keyboard'=> [
[['text'=> "⬅️ برگشت"]]
],'resize_keyboard'=> true
]);
$update = json_decode(file_get_contents('php://input'),true);
if(isset($update['message'])){
$message = $update['message'];
$chat_id = $message['chat']['id'];
$text = $message['text'];
$message_id = $message['message_id'];
$from_id = $message['from']['id'];
}
if(isset($update['callback_query'])){
$call = $update['callback_query'];
$chat_id = $call['message']['chat']['id'];
$sendPost = $call['message']['text'];
$message_id = $call['message']['message_id'];
$from_id = $call['from']['id'];
$data = $call['data'];
$id = $call['id'];
}
$admin = [*[ADMIN]*]; 
$channel = '@[*[CHANNEL]*]';
$users = file_get_contents("users.txt");
$box = file_get_contents("box.txt");
$date = file_get_contents("data/$from_id/date.txt");
$step = file_get_contents("data/$from_id/step.txt");
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
if ($day <= 2){
sm($chat_id, "ادمین گرامی مدت زمان اشتراک شما در رباتساز بزرگ ما ب اتمام رسیده است ⚠️
برای تمدید ربات خود به پیوی ادمین مراجعه کنید ❤️", $message_id, $keyHome);
exit();
}
if(preg_match('/^\/start$/i',$text)){
if(!in_array($from_id, explode("\n",$users))){
save("users.txt","$from_id\n");
mkdir("data/$from_id");
}
sm($chat_id, "🤚 سلام خوش امدید", $message_id, $keyHome);
}
elseif($text == "⬅️ برگشت"){
sm($chat_id, "🏛 به منوی اصلی برگشتیم", $message_id, $keyHome);
put("data/$from_id/step.txt","none");
}

elseif($text == "📝 گزاشتن پست"){
if(time() > $date){
sm($chat_id, "📝 پست خود را ارسال کنید", $message_id, $keyBack);
put("data/$from_id/step.txt","Post");
}else{
$sec = $date - time();
sm($chat_id, "⏳ هر 150 ثانیه میتوان یک پست ارسال کرد.\n⏰ زمان ارسال پست بعدی $sec ثانیه", $message_id, $keyHome);
}
}
elseif($step == 'Post'){
if(isset($text)){
$keyPost = json_encode(['inline_keyboard'=>[[['text'=>"✅ تایید پست",'callback_data'=> "send_$from_id"],['text'=>"⛔️ رد کردن",'callback_data'=> "back_$from_id"]],[['text'=>"ℹ️ اطلاعات",'callback_data'=> "info_$from_id"]]]]);
sm($chat_id, "🔺 پست شما در حال برسی میباشد‌‌‌...", $message_id, $keyHome);
sm($admin, "$text", null, $keyPost);
put("data/$from_id/date.txt",time()+150); //150 sec
put("data/$from_id/step.txt","none");
}else{
sm($chat_id, "❗️ ارسال پیت فقط بصورت متن مجاز است", $message_id, $keyBack);
}
}
elseif(preg_match('/^send_(.*)/',$data,$m)){
sm($channel, " 
$sendPost

‌ ꧁( $channel )꧂");
edit($chat_id, $message_id, "✅ پست کاربر در کانال ارسال شد.");
sm($m[1], "✅ پست شما با موفقیت در کانال ارسال گردید.");
exit();
}
elseif(preg_match('/^back_(.*)/',$data,$m)){
edit($chat_id, $message_id, "✅ پیام رَد پست برای کاربر ارسال شد.");
sm($m[1], "⛔️ پست شما قابل قبول نبود و توسط ادمین رد شد.");
exit();
}
elseif(preg_match('/^info_(.*)/',$data,$m)){
$get = get($m[1]);
alert($id, "👤 نام : {$get['result']['first_name']}
🆔 یوزرنیم : @{$get['result']['username']}", true);
}
//ارتقا دهنده دیباگ کننده سورس @HOKOMAT_ARAB
//اولین چنل اوپن کننده @noori_team_810

?>