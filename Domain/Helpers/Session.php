<?php

namespace Domain\Helpers;

use Domain\Interfaces\SessionInterface;
use Infrastructure\Facades\Config;
use Laminas\Session\Container;
use Laminas\Session\SessionManager;
use Laminas\Session\Validator\HttpUserAgent;
use Laminas\Session\Validator\RemoteAddr;

final class Session implements SessionInterface
{
    private Container $sessionContainer;

    public function __construct()
    {
        $sessionManager = new SessionManager();

        $validatorChain = $sessionManager->getValidatorChain();

        foreach (Config::get('session.validators') as $validatorClass) {
            switch ($validatorClass) {
                case HttpUserAgent::class:
                    $validator = new $validatorClass($_SERVER['HTTP_USER_AGENT'] ?? null);
                    break;
                case RemoteAddr::class:
                    $validator  = new $validatorClass($_SERVER['REMOTE_ADDR'] ?? null);
                    break;
                default:
                    $validator = new $validatorClass();
                    break;
            }

            $validatorChain->attach('session.validate', [$validator, 'isValid']);
        }

        Container::setDefaultManager($sessionManager);
        $this->sessionContainer = new Container();

        $this->sessionContainer->getManager()
            ->start();
    }

    public function set(
        string $key,
        mixed $value
    ): void {
        $this->sessionContainer->offsetSet(
            $key,
            $value
        );
    }

    public function get(string $key): mixed
    {
        return $this->sessionContainer->offsetGet(
            $key
        );
    }

    public function getFlash(string $key): mixed
    {
        $data = $this->get($key);

        $this->delete($key);

        return $data;
    }

    public function delete(string $key): void
    {
        $this->sessionContainer->offsetUnset(
            $key
        );
    }
}