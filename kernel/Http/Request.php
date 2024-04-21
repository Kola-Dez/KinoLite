<?php

namespace App\Kernel\Http;

use App\Kernel\Validator\Validator;
use App\Kernel\Validator\ValidatorInterface;

readonly class Request implements RequestInterface
{
    private ValidatorInterface $validator;
    public function __construct(
        public array $get,
        public array $post,
        public array $server,
        public array $files,
        public array $cookies
    ){
    }
    public static function createFromGlobals(): static
    {
        return new static($_GET, $_POST, $_SERVER, $_FILES, $_COOKIE);
    }
    public function uri(): string
    {
        return strtok($this->server['REQUEST_URI'], '?');
    }
    public function method(): string
    {
        return $this->server['REQUEST_METHOD'];
    }
    public function input(string $key, $default = null): mixed
    {
        return $this->post[$key] ?? $this->get[$key] ?? $default;
    }
    public function setValidator(ValidatorInterface $validator): void
    {
        $this->validator = $validator;
    }
    public function validate(array $rules): bool
    {
        $data = [];
        foreach ($rules as $field => $rule){
            $data[$field] = $this->input($field);
        }
        return $this->validator->validate($data, $rules);
    }
    public function errors(): array
    {
        return $this->validator->errors();
    }
}