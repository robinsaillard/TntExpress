<?php 

namespace RS\TntExpress;

use Exception;

class Locale
{
    public function loadXls($file)
    {
        $directory = __DIR__ . '/Views/';
        $path_file = $directory . $file .".xsl"; 
        if (file_exists($path_file)) {
            return $path_file;
        }else {
            throw new Exception("Aucun fichier trouvé : " . $path_file);         
        }
    }
}
