<?php

namespace App\Http\Telegram;

use DefStudio\Telegraph\Enums\ChatActions;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;


class Handler extends WebhookHandler
{
    public function start()
    {
        $this->deleteKeyboard();
        $photoPath = public_path('images/passport.jpg');
        $this->chat->photo($photoPath)->message('Представьтесь!')->Keyboard(Keyboard::make()->buttons([
            Button::make('Улечка')->action('welcome')->param('name', 'Улечка'),
            Button::make('Ульянка')->action('welcome')->param('name', 'Ульянка'),
            Button::make('Улюлюня')->action('welcome')->param('name', 'Улюлюня'),
            Button::make('Ушка')->action('welcome')->param('name', 'Ушка'),
        ])->chunk(2))->send();
    }
    public function welcome($name)
    {
        $this->chat->message("Привет, $name!")->send();
        sleep(1);
        $this->chat->message("Восьмое марта день тяжелый,\nВсе донимают, пупок кусают.\nСудьба, она как узорчатый лед,\nУлька, Улечка, Ульянка, вперед!")->send();
        sleep(4);
        $this->chat->message("Тут тебя  награда ждет,\nРазгадай загадки, дай ответ!\nСокровище, не торопись,\nВедь \"понять\" в этом доме – великая сила.")->send();
        $photoPath = public_path('images/oh.jpg');
        sleep(4);
        $this->chat->photo($photoPath)->Keyboard(Keyboard::make()->buttons([
            Button::make("Охх, 🥴")->action('warning')->param('name', "$name"),]))->send();

    }

    public function warning($name):void
    {
        $photoPath = public_path('images/questions.jpg');
        $this->chat->photo($photoPath)->send();
        $this->chat->message("$name, приготовься к сложнейшему испытанию!")->send();
        sleep(2);
        $this->chat->message("Тебе предстоит сложнейшая задача!\nОтгадывать глупки-загадудки!\nЧитаешь загадку вот эту\n Находишь подарок с бумажкой  Вводишь руками текст с бумажки Получаешь новую загадку")->send();
        sleep(5);
        $photoPath = public_path('images/under.jpg');
        $this->chat->photo($photoPath)->Keyboard(Keyboard::make()->buttons([
            Button::make("Поняла 😥")->action('enigma1')->param('name', "$name")]))->send();
    }

    public function enigma1($name):void
    {
        $this->chat->message("Здесь $name крутит-вертит для того чтобы быть не злой")->send();
    }

    public function micro():void
    {
        $this->chat->message("В красном ходит - всех заводит")->send();
    }
    public function kurt():void
    {
        $this->chat->message("Трусик внутри. Сасулька перед сидит и головой крутит")->send();
    }

    public function wash():void
    {
        $this->chat->message("Тут прячут сладкие подарки")->send();
    }

    public function floor():void
    {
        $this->chat->message("Ну тут это самое")->send();
    }

}
