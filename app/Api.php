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
                $date = new \DateTime($data[1]);
                $ch = curl_init(URL . "turnos/{$date->format('Y-m-d')}");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $info = curl_exec($ch);
                curl_close($ch);

                $turns_time = array_map(function($date) {
                    return "- {$date["time"]}";
                },json_decode($info, true)["data"]);

                $response = "Turnos para la fecha {$date->format('d-m-Y')}:\n\n" . join("\n", $turns_time);

                $bot->sendMessage($message->getChat()->getId(), $response);
            });
            $bot->command("reservar", function($message) use($bot){
                $data = explode(" ", $message->getText());
                $dni = $data[1];
                $date = $data[2];
                $time = $data[3];

                $date = new \DateTime($date);
                $ch = curl_init(URL . "turnos/{$dni}/fecha/{$date->format('Y-m-d')}/hora/{$time->format('H:m:s')}");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $info = curl_exec($ch);
                curl_close($ch);

                $response = json_decode($info, true);

                $bot->sendMessage($message->getChat()->getId(), $response["message"]);
            });
            $bot->command("turnos_activos", function($message) use($bot){
                $bot->sendMessage($message->getChat()->getId(), "Comming soon");
            });
            $bot->command("turno", function($message) use($bot){
                $bot->sendMessage($message->getChat()->getId(), "Comming soon");
            });
            $bot->command("help", function($message) use($bot){
                $response = "Ayuda\n";
                $response .= "Comandos disponibles:\n";
                $response .= "  - /turnos aaaa-mm-dd\n";
                $response .= "    Se mostraran los turnos disponibles para el dia aaaa-mm-dd\n\n";
                $response .= "  - /reservar dni dd-mm-aaaa hh:mm\n";
                $response .= "    Se reservará un turno para la persona con dni en la fecha y hora especificada\n\n";
                $response .= "  - /turnos_activos\n";
                $response .= "    Se muestran tus turnos activos.\n\n";
                $response .= "  - /turno dni\n";
                $response .= "    Se muestran los turnos activos para la persona con dni especificado";
                $bot->sendMessage($message->getChat()->getId(), $response);

            });
            $bot->run();
        } catch (\TelegramBot\Api\Exception $e) {
            $e->getMessage();
        }
    }
}
