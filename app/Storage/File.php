<?php namespace App\Storage;

/**
 * @author Ulises J. Cornejo Fandos
 */
class File
{
    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function content()
    {
        $lines = '';
        $f = new \SplFileObject($this->file);

        while (!$f->eof()) {
            $lines .= $f->fgets();
        }

        return (string) $lines;
    }

    public function write($content)
    {
        $f = new \SplFileObject($this->file, 'w');
        return (int) $f->fwrite($content);
    }
}
