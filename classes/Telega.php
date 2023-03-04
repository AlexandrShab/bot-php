<?php
class Telega
{
    function sendMes($chat_id, $text)//возвращает message_id
    {
        $method = 'sendMessage';
        $data_to_send = [
            'chat_id'    => $chat_id,
            'text'       => $text,
            'parse_mode' => 'HTML',
            ];
        $res = $this->sendPost($method, $data_to_send);
        return $res['result']['message_id'];
    }
    function sendKeyboard($chat_id, $text, $keyboard)
    {
        $method = 'sendMessage';
        $data_to_send = [
                            'chat_id' => $chat_id,
                            'text' => $text,
                            'parse_mode' => 'HTML',
                            'reply_markup' => [
                                'resize_keyboard' => true,
                                'keyboard' => $keyboard,
                                        ],
                        ];
        $res = $this->sendPost($method, $data_to_send);
        return $res['result']['message_id'];
    }
    function sendInlineKeyboard($chat_id, $text, $keyboard)
    {
        $method = 'sendMessage';
        $data_to_send = [
                            'chat_id' => $chat_id,
                            'text' => $text,
                            'parse_mode' => 'HTML',
                            'reply_markup' => [
                                'inline_keyboard' => [
                                    [
                                        ['text' => '▶️ НАПИСАТЬ ЭКСПЕРТУ', 'url' => 'http://t.me/blondin_man'],
                                    ],
                                ],//$keyboard,
                            ],
                        ];
        $res = $this->sendPost($method, $data_to_send);
        //return $res['result']['message_id'];
    }
    function answerCallbackQuery($callback_id, $text, $alert)
    {
        $method = 'answerCallbackQuery';
        $data_to_send['callback_query_id'] = $callback_id;
        $data_to_send['text'] = $text;
        $data_to_send['show_alert'] = 'true';//$alert
        
        $res = $this->sendPost($method, $data_to_send);
    }
    function sendAction($chat_id)
    {
        $data['chat_id'] = $chat_id;
        $data['action'] = 'typing';
        $this->sendPost('sendChatAction', $data);
    }
    //~~~~~~~~~~~~~~~~~~~~
    function sendPost($method, $data, $headers = [])
    {
        $curl = curl_init();
        curl_setopt_array($curl,[
            CURLOPT_POST            => 1,
            CURLOPT_HEADER          => 0,
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_URL             => TELEGA_URL . '/' . $method,
            CURLOPT_POSTFIELDS      => json_encode($data),
            CURLOPT_HTTPHEADER      => array_merge(array("Content-Type: application/json"), $headers),
        ]);
        $result = curl_exec($curl);
        curl_close($curl);
        return (json_decode($result, 1) ? json_decode($result, 1) : $result);
    }
}