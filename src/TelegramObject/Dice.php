<?php

namespace WeStacks\TeleBot\TelegramObject;

use WeStacks\TeleBot\TelegramObject;

/**
 * This object represents an animated emoji that displays a random value.
 * 
 * @property String     $emoji       Emoji on which the dice throw animation is based
 * @property Integer    $value       Value of the dice, 1-6 for “🎲” and “🎯” base emoji, 1-5 for “🏀” base emoji
 * 
 * @package WeStacks\TeleBot\TelegramObject
 */

class Dice extends TelegramObject
{
    protected function relations()
    {
        return [
            'emoji'     => 'string',
            'value'     => 'integer'
        ];
    }
}