<?php


namespace App\Middlewares;


use Laminas\Diactoros\Response\EmptyResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthenticationMiddleware implements MiddlewareInterface
{

    /**
     * @inheritDoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($request->getUri()->getPath() === '/primer-proyecto-php/admin') {
            $sesionUserId = $_SESSION['userId'] ?? null;
            if (!$sesionUserId) {
                //regresamos
                return new EmptyResponse(401);
            }
        }

        return $handler->handle($request);
    }
}