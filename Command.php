<?php

/**
 * @property-read string  $name - Название
 * @property-read string  $description - Описание
 * @property-read Closure $method - Собственно функция, выполняемая командой
 */
class Command
{
    public function __construct(
        protected string  $name,
        protected string  $description,
        protected Closure $method
    ){}

    /**
     * Вызов собственно функции
     * @param array $arguments
     * @param array $options
     *
     * @return void
     */
    public function call(array $arguments = [], array $options = []): void
    {
        if (in_array('help', $arguments, true)) {
            echo "$this->description\n";
            return;
        }

        $this->method->call($this, $arguments, $options);
    }

    public function __get(string $name)
    {
        return $this->$name;
    }
}