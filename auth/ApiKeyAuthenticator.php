<?php


namespace Auth;

use Auth\Resources\Base\ApiKeyQuery;
use Psr\Log\LoggerInterface;
use Silex\Application;
use Symfony\Component\Security\Core\Authentication\SimplePreAuthenticatorInterface;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;

class ApiKeyAuthenticator implements SimplePreAuthenticatorInterface, AuthenticationFailureHandlerInterface
{

    protected $userProvider;
    protected $paramName;

    public function __construct( ApiKeyUserProvider $userProvider, $paramName, LoggerInterface $logger)
    {
        $this->paramName = $paramName;
        $this->userProvider = $userProvider;
    }

    public function authenticateToken( TokenInterface $token, UserProviderInterface $userProvider, $providerKey )
    {
        list($apiKey, $signature, $headers) = $token->getCredentials();
        $username = $this->userProvider->getUsernameForApiKey($apiKey);

        if (!$username) {
            throw new AuthenticationException(
                sprintf('API Key "%s" does not exist.', $apiKey)
            );
        }

        $user = $this->userProvider->loadUserByUsername($username);

        //Generate local signature and compare with the one sent
        $key = ApiKeyQuery::create()->findByValue($apiKey)->getFirst();
        $localSignature = md5(serialize($headers) . $key->getSecret());

        var_dump($signature);

        if(strcmp($localSignature,$signature)!==0){
            throw new AuthenticationException('API signature is not valid');
        }

        return new PreAuthenticatedToken(
            $user,
            $apiKey,
            $providerKey,
            $user->getRoles()
        );
    }

    public function supportsToken( TokenInterface $token, $providerKey )
    {
        return $token instanceof PreAuthenticatedToken && $token->getProviderKey() === $providerKey;
    }

    public function createToken( Request $request, $providerKey )
    {
        $apiKey = $request->query->get($this->paramName);
        $headers = $request->headers->all();
        $signature = isset($headers['x-signature'])?$headers['x-signature'][0]:"";
        unset($headers['x-signature']);

        if(!$apiKey){
            throw new BadCredentialsException('No API key provided.');
        }

        return new PreAuthenticatedToken(
            'annon.',
            array($apiKey, $signature, $headers),
            $providerKey
        );
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new Response("Authentication Failed.", 403);
    }
}