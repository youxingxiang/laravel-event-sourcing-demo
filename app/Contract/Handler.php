<?php


namespace App\Contract;


interface Handler
{
    public function handle(Command $command): void;
}
