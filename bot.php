<?php

/*API BY @scriptkiddie_08*/

/*Add your country timezone accordingly*/

date_default_timezone_set('Asia/Kolkata');

$content = file_get_contents("php://input");

    $update = json_decode($content, true);

    $chat_id = $update["message"]["chat"]["id"];

    $message = $update["message"]["text"];

    $message_id = $update["message"]["message_id"];

    $id = $update["message"]["from"]["id"];

    $username = $update["message"]["from"]["username"];

    $firstname = $update["message"]["from"]["first_name"];

      $start_msg = $_ENV['START_MSG'];

if($message == "/start" || $message == "/use" || $message == "/cmds"){

      

        send_MDmessage($chat_id,$message_id,

	 "Hey $firstname	 \nUse Following Commands :-
\n/ip <1.1.1.1> or site <google.com> to get IP information.");

    }

    

$command = explode(" ", $message, 2)[0];

if ($command == "/ip" || $command == "/proxy" || $command == "!ip" || $command == "!proxy")

{

    

    $ip = explode(" ", $message, 3)[1];

    if ($ip == "")

    {

        send_message($chat_id,$message_id, "You bitch ...!! Enter a IP or Site.");

    }

 else

{      

        $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, "https://demo.ip-api.com/json/$ip?fields=66846719&lang=en");

      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

      curl_setopt($ch, CURLOPT_HTTPHEADER, array(

      'accept: */*',

      'Origin: https://ip-api.com',

      'Referer: https://ip-api.com/',

      'user-agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36'

      ));

      $ip_info = json_decode(curl_exec($ch), true);

$country = $ip_info['country'];

$status = $ip_info['status'];

$proxy = $ip_info['proxy'];

switch ($proxy) {

            case '1':

                $proxy = 'true ✅';

                break;

            case '0':

                $proxy = 'false ❌';

                break;

            default:

                $proxy = 'null 0️⃣';

                break;

            

        }

$mobile = $ip_info['mobile'];

switch ($mobile) {

            case '1':

                $mobile = 'true ✅';

                break;

            case '0':

                $mobile = 'false ❌';

                break;

            default:

                $mobile = 'null 0️⃣';

                break;

        }

$continent = $ip_info['continent'];

$hosting = $ip_info['hosting'];

switch ($hosting) {

            case '1':

                $hosting = 'true ✅';

                break;

            case '0':

                $hosting = 'false ❌';

                break;

            default:

                $hosting = 'null 0️⃣';

                break;

        }

$regionName = $ip_info['regionName'];

$isp = $ip_info['isp'];

$org = $ip_info['org'];

$as = $ip_info['as'];

$city = $ip_info['city'];

$zip = $ip_info['zip'];

$timezone = $ip_info['timezone'];

$reverse = $ip_info['reverse'];

$dateTime = date('d/M/y h:i:a');

$lat = $ip_info['lat'];

$lon = $ip_info['lon'];

$offset = $ip_info['offset'];

$region = $ip_info['region'];

$currency = $ip_info['currency'];

if (!empty($ip_info))

{

$data ="🪄👨‍💻User IP ➦ $ip\n ✅Status ➔ $status\n 📡Proxy ➜ $proxy\n 🏙City: ➱ $city\n 🏘Zipcode ➠ $zip\n 🌍State ---» $regionName\n 📶Isp ➢ $isp\n 🏢Org ➔ $org \n 📟As -» $as\n 🕔Timezone ➠ $timezone\n 🔢IP Log (IST) -> $dateTime\n 🌎Country ➮ $country\n 🌐Continent ➯ $continent\n ✪Latitude✪ ~> $lat\n ⍟Longitude⍟ ➸ $lon\n 📵Mobile ➛ $mobile\n 📲Hosting ➸ $hosting\n 🏙️Region ->» $region \n📏Offset ➮ $offset \n💲Currency -› $currency\n 🔄Reverse ~> $reverse

\n🤖Bot By :- scriptkiddie_08\n⚠️Checked By @$username ";

            send_message($chat_id,$message_id, $data);

        

}

    else

        {

            send_message($chat_id,$message_id, "Invalid  IP Asshole ..!!");

        }

}

 

}

function send_MDmessage($chat_id,$message_id, $message){

        $text = urlencode($message);

        $apiToken = $_ENV['API_TOKEN'];  

        file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chat_id&reply_to_message_id=$message_id&text=$text&parse_mode=Markdown");

    }

    

 function send_message($chat_id,$message_id, $message)

{

    $data = urlencode($message);

    $apiToken = $_ENV['API_TOKEN'];  

    file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chat_id&reply_to_message_id=$message_id&text=$data&parse_mode=html");

}

?>
