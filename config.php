<?php
/*
اپن شده در کانال @noori_team_810
نویسنده سورس: @HOKOMAT_ARAB
*/
ob_start();
define('API_KEY', getenv('BOT_TOKEN') ?: ''); //توکن قرار دهید
$Dev = 7575502917;
$channel = "noori_team_810";  //ایدی چنل
$botuser = "NOORI_BOT_SAZ2_BOT"; //یوزرنیم بات
$idbot = "t.me/NOORI_BOT_SAZ2_BOT"; //ایدی ربات خود
$publicDomain = getenv('PUBLIC_URL') ?: getenv('RAILWAY_PUBLIC_DOMAIN') ?: ($_SERVER['HTTP_HOST'] ?? '');
$publicDomain = preg_replace('#^https?://#i', '', trim($publicDomain));
$folder = $publicDomain !== '' ? 'https://' . rtrim($publicDomain, '/') : ''; // آدرس عمومی سرویس
//-------------------------------فانکشن ها---------------------------------------------
function bot($method, $datas = [])
{
    $url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    if (curl_error($ch)) {
        var_dump(curl_error($ch));
    } else {
        return json_decode($res);
    }
}
function SendMessage($chat_id, $text, $parse_mode = 'MarkDown', $disable_web_page_preview = null)
{
    $data = ['chat_id' => $chat_id, 'text' => $text, 'parse_mode' => $parse_mode];
    if ($disable_web_page_preview !== null) $data['disable_web_page_preview'] = filter_var($disable_web_page_preview, FILTER_VALIDATE_BOOLEAN);
    return bot('sendMessage', $data);
}
function save($filename, $data)
{
    $file = fopen($filename, 'w');
    fwrite($file, $data);
    fclose($file);
}
function SendDocument($chat_id, $document, $caption = null)
{
    bot('SendDocument', [
        'chat_id' => $chat_id,
        'document' => $document,
        'caption' => $caption
    ]);
}
function SendPhoto($chat_id, $photo, $caption = null)
{
    bot('SendPhoto', [
        'chat_id' => $chat_id,
        'photo' => $photo,
        'caption' => $caption
    ]);
}
function deleteFolder($path)
{
    if (is_dir($path) === true) {
        $files = array_diff(scandir($path), array('.', '..'));
        foreach ($files as $file)
            deleteFolder(realpath($path) . '/' . $file);
        return rmdir($path);
    } else if (is_file($path) === true)
        return unlink($path);
    return false;
}
function Forward($kojashe, $azkoja, $kodommsg)
{
    bot('forwardmessage', [
        'chat_id' => $kojashe,
        'from_chat_id' => $azkoja,
        'message_id' => $kodommsg
    ]);
}
function LeaveChat($chat_id)
{
    bot('LeaveChat', [
        'chat_id' => $chat_id
    ]);
}
function memUsage($units = false)
{
    $status = @file_get_contents('/proc/' . getmypid() . '/status');
    if ($status !== false && preg_match_all('~^(VmRSS|VmSwap):\s*([0-9]+)~im', $status, $m)) $size = array_sum(array_map('intval', $m[2]));
    else $size = (int) round(memory_get_usage(true) / 1024);
    if (!$units) return $size;
    if ($size >= 1024*1024) return round($size/(1024*1024),2).' GB';
    if ($size >= 1024) return round($size/1024,2).' MB';
    return $size.' KB';
}
function getMUsage()
{
    return round(memory_get_usage(true) / 1024, 2) . ' KB';
}
function Spam($user_id)
{
    @mkdir("usersData/spam");
    $spam_status = json_decode(file_get_contents("usersData/spam/$user_id.json"), true);
    if ($spam_status != null) {
        if (mb_strpos($spam_status[0], "time") !== false) {
            if (str_replace("time ", null, $spam_status[0]) >= time())
                exit(false);
            else
                $spam_status = [1, time() + 2];
        } elseif (time() < $spam_status[1]) {
            if ($spam_status[0] + 1 > 3) {
                $time = time() + 1800;
                $spam_status = ["time $time"];
                file_put_contents("usersData/spam/$user_id.json", json_encode($spam_status, true));
                bot('sendMessage', [
                    'chat_id' => $user_id,
                    'text' => "➖➖➖➖➖➖➖➖➖➖
⚠️ به علت ارسال پیام مکرر 30 دقیقه مسدود شدید

❗️ لطفا آهسته تر با ربات کار کنید 
➖➖➖➖➖➖➖➖➖➖",
                ]);
                exit(false);
            } else {
                $spam_status = [$spam_status[0] + 1, $spam_status[1]];
            }
        } else {
            $spam_status = [1, time() + 2];
        }
    } else {
        $spam_status = [1, time() + 2];
    }
    file_put_contents("usersData/spam/$user_id.json", json_encode($spam_status, true));
}
/*
اپن شده در کانال @noori_team_810
نویسنده سورس: @HOKOMAT_ARAB
*/
