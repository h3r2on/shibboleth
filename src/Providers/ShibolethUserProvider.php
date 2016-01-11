<?php

namespace H3r2on\Shibboleth\Providers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider as UserProviderInterface;
use Illuminate\Hashing\BcryptHasher;

class ShibbolethUserProvider implements UserProviderInterface
{
		/**
		 * placeholder for the bcrpyt hashing class
		 * @var Object
		 */
		protected $hasher;

		/**
		 * The user model
		 * @var Object
		 */
    protected $model;

		/**
		 * Class Constructor
		 * @param BcryptHasher $bcryptHasher
		 * @param Object       $model
		 */
    public function __construct(BcryptHasher $bcryptHasher, $model)
    {
        $this->hasher = $bcryptHasher;
        $this->model = $model;
    }


    /**
     * @param mixed $identifier
     * @return \Illuminate\Auth\Authenticatable | null
     */
    public function retrieveById($identifier)
    {
        $user = $this->retrieveByCredentials(array('id' => $identifier));
        if ($user && $user->getAuthIdentifier() == $identifier) {
            return $user;
        }
        return null;
    }

    /**
     * @param array $credentials
     * @return \Illuminate\Auth\Authenticatable | null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if(count($credentials) == 0) {
            return null;
        }

        $user = new $this->model;

        $query = $user->newQuery();

        foreach($credentials as $key => $value) {
            if(!str_contains($key, 'password')) {
                $query->where($key, $value);
            }
        }

        return $query->first();
    }

    /**
     * @param Authenticatable $user
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        if ($user->type == 'local') {
            $plain = $credentials['password'];
            return $this->hasher->check($plain, $user->getAuthPassword());
        }
        return true;
    }

    /**
     * @param Authenticatable $user
     * @param string $token
     *
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        // Not Implemented.
    }

    /**
     * @param mixed $identifier
     * @param string $token
     *
     * @return void
     */
    public function retrieveByToken($identifier, $token)
    {
        // Not Implemented.
    }
}
