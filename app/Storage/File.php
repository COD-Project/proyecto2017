<?php namespace App\Storage;

/**
 * @author Ulises J. Cornejo Fandos
 */
class File
{
    protected $path;

    public function __construct($file)
    {
        $this->path = $file;
    }

    public function content()
    {
        $lines = '';
        $file = new \SplFileObject($this->path);

        if (!$file->flock(LOCK_EX | LOCK_NB)) {
            throw new \Exception("Error Locking File", 1);
        }

        while (!$file->eof()) {
            $lines .= $file->fgets();
        }

        $file->flock(LOCK_UN);

        return (string) $lines;
    }

    public function write($content)
    {
        $file = new \SplFileObject($this->path, 'w');

        if (!$file->flock(LOCK_EX | LOCK_NB)) {
            throw new \Exception("Error Locking File", 1);
        }

        $file->ftruncate(0);
        $success = $file->fwrite($content);
        $file->flock(LOCK_UN);

        return $success;
    }

    /**
     * Delete file
     *
     * @return bool true if success, false if does no exists
     */
    public function delete()
    {
        if (file_exists($this->path)) {
            unlink($this->path);
            return true;
        }

        return false;
    }

    /**
     * Returns the extension of any file, no matter if it is just the name or path with the name
     *
     *
     * @return mixed string with the extension, returns an empty string if there is no information about the extension
     */
    public function getFileExt()
    {
        return pathinfo($this->path, PATHINFO_EXTENSION);
    }

    /**
     * Returns the size in Kbytes of a file
     *
     * @return int
     */
    public function size()
    {
        return (int) round(filesize($this->path) * 0.0009765625, 1);
    }

    /**
     * Returns the exact date and time of creation of a file
     *
     * @return string d-m-y h:i:s
     */
    public function creationDate()
    {
        return date('d-m-Y h:i:s', filemtime($this->path));
    }

    /**
     * Creates a directory
     *
     * @param string
     * @param int $permissions
     *
     * @return bool
     */
    public static function createDir($route, $permissions = 0755)
    {
        if (is_dir($route)) {
            return false;
        }

        return (bool) mkdir($route, $permissions, true);
    }
}
