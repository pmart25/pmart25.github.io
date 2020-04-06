<?php


/**
*
*  project  NCM_Backup
*  @file backup_zip.php
*  @user pablo torrico
*  email  p_torrico@hotmail.com
*  url  www.neoconceptmedia.com
*  @brief   functions for backup and send to e-mail address.
*/



/*
 * PHP: Recursively Backup Files & Folders to ZIP-File
 * (c) 2012-2014: Marvin Menzerath - http://menzerath.eu
*/
// Make sure the script can handle large folders/files
ini_set('max_execution_time', 600);
ini_set('memory_limit','1024M');
// Start the backup!

$destination = '/home/a7010140/public_html/pub_test/app/backup.zip';

$source = '/home/a7010140/public_html/pub_test/';

//$resp = zipData('/home/a7010140/public_html/pub_test/', '/home/a7010140/public_html/pub_test/app/backup.zip');



//$resp =Zip ($source, $destination);
//echo 'Finished. '.$resp;
echo "\n";
// Here the magic happens :)
function zipData($folder, $zipTo) {
	if (extension_loaded('zip')) {
		if (file_exists($source)) {
			$zip = new ZipArchive();
			if ($zip->open($destination, ZIPARCHIVE::CREATE)) {
				$source = realpath($source);
				if (is_dir($source)) {
					$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
					foreach ($files as $file) {
						$file = realpath($file);
						if (is_dir($file)) {
							$zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
						} else if (is_file($file)) {
							$zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
						}
					}
				} else if (is_file($source)) {
					$zip->addFromString(basename($source), file_get_contents($source));
				}
			}
			return $zip->close();
		}
	}
	return false;
}

function Zip($source, $destination)
{
    if (!extension_loaded('zip') || !file_exists($source)) {
        return false;
    }

    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }

    $source = str_replace('\\', '/', realpath($source));

    if (is_dir($source) === true)
    {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file)
        {
            $file = str_replace('\\', '/', $file);

            // Ignore "." and ".." folders
            if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                continue;

            $file = realpath($file);

            if (is_dir($file) === true)
            {
                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
            }
            else if (is_file($file) === true)
            {
                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
            }
        }
    }
    else if (is_file($source) === true)
    {
        $zip->addFromString(basename($source), file_get_contents($source));
    }

    return $zip->close();
}

?>