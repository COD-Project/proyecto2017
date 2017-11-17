<?php namespace App;

/**
 * @author Lucas Di Cunzolo
 */

class Api
{
    const API_TELEGRAM_TOKEN = "456440817:AAFMl9hVYUXeGR8qiDmk4ua2_rphI16l2_w";
    const API_BOTAN_TRACKER_TOKEN = "";

    public function __construct()
    {
        try {
            $bot = new \TelegramBot\Api\Client(self::API_TELEGRAM_TOKEN);
            $bot->command("turnos", function($message) use($bot){
                $data = explode(" ", $message->getText());
                $ch = curl_init(URL . "turnos/{$data[1]}");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $info = curl_exec($ch);
                curl_close($ch);

                $data = array_map(function($date) {
                    return "Turno {$date["time"]}";
                },json_decode($info, true)["data"]);

                $date = (new \DateTime($data[1]))->format('d-m-Y');

                $message = "Turnos para la fecha {$date}\n\n";
                $message .= join("\n", $data);

                $bot->sendMessage($message->getChat()->getId(), $message);
            });
            $bot->run();
        } catch (\TelegramBot\Api\Exception $e) {
            $e->getMessage();
        }
    }
}
