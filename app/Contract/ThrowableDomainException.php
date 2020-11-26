<?php


namespace App\Contract;

use Illuminate\Support\MessageBag;

class ThrowableDomainException extends \DomainException
{
    public static function throwIt($msg, $code = 401): self
    {
        throw new static($msg, $code);
    }

    public function render()
    {
        $error = new MessageBag([
            'title'   => '错误',
            'message' => $this->getMessage(),
        ]);
        return back()->withInput()->with(compact('error'));

    }
}
