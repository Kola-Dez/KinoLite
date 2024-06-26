<?php

namespace App\Kernel\Controller;

use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\SessionInterface;
use App\Kernel\View\ViewInterface;
use Exception;

abstract class Controller
{
    private ViewInterface $view;
    private RequestInterface $request;
    private RedirectInterface $redirect;
    private SessionInterface $session;

    /**
     * @throws Exception
     */
    public function view(string $name): void
    {
        $this->view->page($name);
    }
    public function setView(ViewInterface $view): void
    {
        $this->view = $view;
    }

    public function request(): RequestInterface
    {
        return $this->request;
    }
    public function setRequest(RequestInterface $request): void
    {
        $this->request = $request;
    }
    public function setRedirect(RedirectInterface $redirect): void
    {
        $this->redirect = $redirect;
    }
    public function redirect(string $url): RedirectInterface
    {
        return $this->redirect->to($url);
    }
    public function setSession(SessionInterface $session): void
    {
        $this->session = $session;
    }
    public function session(): SessionInterface
    {
        return $this->session;
    }
}