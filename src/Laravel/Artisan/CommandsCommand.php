<?php

namespace WeStacks\TeleBot\Laravel\Artisan;

use function GuzzleHttp\Promise\all;
use Symfony\Component\Console\Helper\TableCell;
use WeStacks\TeleBot\Objects\BotCommand;

class CommandsCommand extends TeleBotCommand
{
    protected $signature = 'telebot:commands
        {bot? : The bot name defined in the config file.}
        {--A|all : Perform actions on all your bots.} 
        {--S|setup : Declare your bot commands on Telegram servers. So the users can use autocompletion.} 
        {--R|remove : Remove your already declared bot commands on Telegram servers.} 
        {--I|info : Get the information about your current bot commands on Telegram servers.}';

    protected $description = 'Ease the Process of setting up and removing bot commands.';

    public function handle()
    {
        if ($error = true !== $this->validOptions()) {
            $this->error($error);

            return 1;
        }

        $bots = $this->botsList();

        if ($this->option('setup')) {
            $this->setupCommands($bots);
        }

        if ($this->option('remove')) {
            $this->removeCommands($bots);
        }

        if ($this->option('info')) {
            $this->getCommands($bots);
        }

        return 0;
    }

    private function setupCommands($bots)
    {
        $promises = [];
        foreach ($bots as $bot) {
            $promises[] = $this->bot->bot($bot)
                ->async(true)
                ->exceptions(true)
                ->setMyCommands([
                    'commands' => $this->bot->bot($bot)->getLocalCommands(),
                ])
                ->then(function (bool $result) use ($bot) {
                    if ($result) {
                        $this->info("Success! Bot commands has been set for '{$bot}' bot!");
                    }

                    return $result;
                })
            ;
        }
        all($promises)->wait();
    }

    private function removeCommands($bots)
    {
        $promises = [];
        foreach ($bots as $bot) {
            $promises[] = $this->bot->bot($bot)
                ->async(true)
                ->exceptions(true)
                ->setMyCommands(['commands' => []])
                ->then(function (bool $result) use ($bot) {
                    if ($result) {
                        $this->info("Success! Bot commands has been removed for '{$bot}' bot!");
                    }

                    return $result;
                })
            ;
        }
        all($promises)->wait();
    }

    private function getCommands($bots)
    {
        $this->alert('Bot Commands');

        $promises = [];
        foreach ($bots as $bot) {
            $promises[] = $this->bot->bot($bot)
                ->async(true)
                ->exceptions(true)
                ->getMyCommands()
                ->then(function (array $commands) use ($bot) {
                    $this->makeTable($commands, $bot);

                    return $commands;
                })
            ;
        }
        all($promises)->wait();
    }

    private function makeTable(array $commands, string $bot)
    {
        $rows = collect($commands)->map(function (BotCommand $command) {
            $key = '/'.$command->command;
            $value = $command->description;

            return compact('key', 'value');
        })->toArray();

        return $this->table([
            [new TableCell('Bot: '.$bot, ['colspan' => 2])],
            ['Command', 'Description'],
        ], $rows);
    }
}