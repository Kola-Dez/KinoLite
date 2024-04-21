<?php

namespace App\Kernel\View;

use App\Kernel\Exceptions\ViewNotFoundException;
use App\Kernel\Session\Session;
use App\Kernel\Session\SessionInterface;
use Exception;

readonly class View implements ViewInterface
{

    public function __construct(
        private SessionInterface $session,
    )
    {
    }

    /**
     * @throws Exception
     */
    public function page(string $name): void
    {
        $viewPath = APP_PATH."/views/pages/$name.php";
        if (!file_exists($viewPath)){
            throw new ViewNotFoundException("View $name not found");
        }
        extract($this->defaultData());


        include_once $viewPath;
    }
    public function component(string $name): void
    {
        $componentsPath = APP_PATH."/views/components/$name.php";
        if (!file_exists($componentsPath)){
            echo "Component $name not found";
            return;
        }

        extract([
            'view' => $this
        ]);

        include_once $componentsPath;
    }
    private function defaultData(): array
    {
        return[
            'view' => $this,
            'session' => $this->session,
        ];
    }
}