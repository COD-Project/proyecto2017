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

                $turns_time = array_map(function($date) {
                    return "- {$date["time"]}";
                },json_decode($info, true)["data"]);

                $date = new \DateTime($data[1]);
                $date = $date->format('d-m-Y');

                $response = "Turnos para la fecha {$date}:\n\n" . join("\n", $turns_time);

                $bot->sendMessage($message->getChat()->getId(), $response);
            });
            $bot->command("help", function($message) use($bot){
                $response = "Ayuda\n";
                $response .= "Comandos disponibles:\n";
                $response .= "  - /turnos aaaa-mm-dd:\n";
                $response .= "    Se mostraran los turnos disponibles para el dia aaaa-mm-dd\n\n";
                $response .= "  - /reservar dni dd-mm-aaaa hh:mm\n";
                $response .= "    Se reservará un turno para la persona con dni en la fecha y hora especificada";
                $bot->sendMessage($message->getChat()->getId(), $response);

            });
            $bot->run();
        } catch (\TelegramBot\Api\Exception $e) {
            $e->getMessage();
        }
    }
}
