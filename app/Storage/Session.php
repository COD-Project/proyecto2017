<?php namespace App\Storage;

use App\Models\User;

/**
 * created by Ulises Jeremias Cornejo Fandos
 */
class Session extends \Mbh\Storage\Session
{
    use \App\Traits\Connection;

    const SESS_APP_ID = 'grupo5_app_id';

    const SESSION_TIME = 18000;

    /**
     * Generates a session for a certain time for a user.
     *
     * @param $id
     *
     * @return void
     */
    public function generateSession($id)
    {
        User::init();

        $this->set(static::SESS_APP_ID, $id);
        $e['session'] = time() + static::SESSION_TIME;
        User::update($e, "id='$id'", 'LIMIT 1');

        return $this;
    }

    public function checkLife($force = false)
    {
        User::init();

        if ($id = $this->get(static::SESS_APP_ID)) {
            $time = time();
            if ($force || count(User::select("id", "id='$id' AND session <= '$time'", "LIMIT 1")) > 0) {
                $e['session'] = 0;
                User::update($e, "id='$id'", "LIMIT 1");
                $this->delete(static::SESS_APP_ID);
                $this->destroy();
            }
        }

        return $this;
    }

    public function isLoggedIn()
    {
        User::init();

        $id = $this->get(static::SESS_APP_ID);
        $time = time();
        if (!($id && User::select("id", "id='$id' AND session >= '$time'", "LIMIT 1"))) {
            return false;
        }

        return true;
    }

    public function sessionInUse()
    {
        User::init();

        if (!$this->isLoggedIn()) {
            return null;
        }

        $id = $this->get(static::SESS_APP_ID);
        return User::find($id);
    }

    public function isGranted()
    {
        return $this->sessionInUse()->hasRole('Administrador');
    }
}
