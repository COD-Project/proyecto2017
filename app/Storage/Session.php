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
        $this->set(static::SESS_APP_ID, $id);
        $e['session'] = time() + static::SESSION_TIME;
        User::update($e, "id='$id'", 'LIMIT 1');

        return $this;
    }

    public function checkLife($force = false)
    {
        if ($id = $this->get(static::SESS_APP_ID)) {
            $time = time();
            if ($force || count(User::select("id", "id='$id' AND session <= '$time'", 1)) > 0) {
                $e['session'] = 0;
                User::update($e, "id='$id'", 1);
                $this->unset(static::SESS_APP_ID);
                $this->destroy();
            }
        }

        return $this;
    }

    public function isLoggedIn()
    {
        $id = $this->get(static::SESS_APP_ID);
        $time = time();
        if (!$id || !User::select("id", "id='$id' AND session <= '$time'", 1)) {
            return false;
        }

        return true;
    }

    public function sessionInUse()
    {
        if (!$this->isLoggedIn()) {
            return $this;
        }

        $id = $this->get(static::SESS_APP_ID);
        return \App\Models\User::find($id);
    }
}
