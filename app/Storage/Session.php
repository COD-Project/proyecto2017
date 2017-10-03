<?php namespace App\Storage;

/**
 * created by Ulises Jeremias Cornejo Fandos
 */
class Session extends \Mbh\Storage\Session
{
    use App\Traits\Connection;

    const SESS_APP_ID = 'grupo5_app_id';

    const SESSION_TIME = 18000;

    /**
     * Generates a session for a certain time for a user.
     *
     * @param int $id
     *
     * @return void
     */
    final public function generateSession($id)
    {
        $this->set(static::SESS_APP_ID, $id);
        $e['session'] = time() + static::SESSION_TIME;
        static::$db->update('usuarios', $e, "id='$id'", 'LIMIT 1');

        return $this;
    }
}
