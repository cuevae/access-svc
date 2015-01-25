<?php


namespace Auth;

use Auth\Resources\Base\ApiKeyQuery;
use Auth\Resources\Base\ConsumerQuery;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException,
    Symfony\Component\Security\Core\Exception\UsernameNotFoundException,
    Symfony\Component\Security\Core\User\User,
    Symfony\Component\Security\Core\User\UserInterface,
    Symfony\Component\Security\Core\User\UserProviderInterface;

class ApiKeyUserProvider implements UserProviderInterface {

    public function getUsernameForApiKey($apiKey)
    {
        //Find if the given apikey exists
        $keys = ApiKeyQuery::create()->filterByValue($apiKey)->find();
        if(!$keys || $keys->count() != 1)
        {
            return null;
        }

        $key = $keys->getFirst();

        return $key->getConsumer()->getUsername();
    }

    /**
     * Loads the user for the given username.
     *
     * This method must throw UsernameNotFoundException if the user is not
     * found.
     *
     * @param string $username The username
     *
     * @return UserInterface
     *
     * @see UsernameNotFoundException
     *
     * @throws UsernameNotFoundException if the user is not found
     */
    public function loadUserByUsername( $username )
    {
        $users = ConsumerQuery::create()->findBy('username', $username);
        if(!$users || $users->count() != 1){
            throw new UsernameNotFoundException();
        }

        $user = $users->getFirst();

        return new User(
            $username,
            null,
            array($user->getRole())
        );
    }

    /**
     * Refreshes the user for the account interface.
     *
     * It is up to the implementation to decide if the user data should be
     * totally reloaded (e.g. from the database), or if the UserInterface
     * object can just be merged into some internal array of users / identity
     * map.
     *
     * @param UserInterface $user
     *
     * @return UserInterface
     *
     * @throws UnsupportedUserException if the account is not supported
     */
    public function refreshUser( UserInterface $user )
    {
        throw new UnsupportedUserException();
    }

    /**
     * Whether this provider supports the given user class.
     *
     * @param string $class
     *
     * @return bool
     */
    public function supportsClass( $class )
    {
        return 'Symfony\Component\Security\Core\User\User' === $class;
    }
}