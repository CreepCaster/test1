<?php

class ConsoleParser
{
    /**
     * @var Command[]
     */
    private $commands = [];

    /**
     * Регистрация команды
     * @param Command $command
     *
     * @return void
     */
    public function register(Command $command)
    {
        $this->commands[$command->name] = $command;
    }

    public function parse($allArgumentsAndOptions)
    {
        array_shift($allArgumentsAndOptions);
        $name = array_shift($allArgumentsAndOptions);
        if (!array_key_exists($name, $this->commands)) {
            $this->printAll();
            return;
        }

        $arguments = [];
        $options = [];

        foreach ($allArgumentsAndOptions as $arg) {
            if (preg_match('/^\[(?P<name>\w+)=(?P<value>\w+)]$/', $arg, $matches)) {
                $options[$matches['name']][] = $matches['value'];
            }
            if (preg_match('/^{?(\w+)}?$/', $arg, $matches)) {
                $arguments[] = $matches[1];
            }
        }

        $this->commands[$name]->call($arguments, $options);
    }

    public function printAll()
    {
        foreach ($this->commands as $command) {
            echo "\033[1m{$command->name}\033[0m: {$command->description}\n";
        }
    }
}