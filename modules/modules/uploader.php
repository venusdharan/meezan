<?php
$upload_dir = 'temp_upload';
$sand_box = 'sandbox';
session_start();
if (!empty($_FILES)) 
{ 
     $tempFile = $_FILES['file']['tmp_name'];//this is temporary server location
     
    // echo "File recieved";

     // using DIRECTORY_SEPARATOR constant is a good practice, it makes your code portable.
     $uploadPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . $upload_dir . DIRECTORY_SEPARATOR;
     Delete($uploadPath);
     mkdir($upload_dir);
     echo $uploadPath;
    // echo "Preparing upload arena";
     // Adding timestamp with image's name so that files with same name can be uploaded easily. $uploadPath.time().'-'.
     $mainFile =  $_FILES['file']['name'];
     $_SESSION['module_install_name'] = $mainFile;
     move_uploaded_file($tempFile,$uploadPath.$mainFile);
    // echo "Creating sandboxed environment";
      $sandboxPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . $sand_box . DIRECTORY_SEPARATOR;
     Delete($sandboxPath);
     mkdir($sandboxPath);
    // echo "Comminting to inflate the package";
       $zip = new ZipArchive;
        if ($zip->open($uploadPath.$mainFile) === TRUE) {
            $zip->extractTo($sandboxPath);
            $zip->close();
        }
        
      echo '<div class="callout callout-info">
                <h4>Module successfully uploaded</h4>

                <p>Follow the steps to continue to continue installation</p>
              </div>';
         
         
}else
{
    echo '<div class="callout callout-danger">
                <h4>Module upload failed</h4>

                <p>Please correct error</p>
              </div>';
}


function Delete($path)
{
    if (is_dir($path) === true)
    {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::CHILD_FIRST);

        foreach ($files as $file)
        {
            if (in_array($file->getBasename(), array('.', '..')) !== true)
            {
                if ($file->isDir() === true)
                {
                    rmdir($file->getPathName());
                }

                else if (($file->isFile() === true) || ($file->isLink() === true))
                {
                    unlink($file->getPathname());
                }
            }
        }

        return rmdir($path);
    }

    else if ((is_file($path) === true) || (is_link($path) === true))
    {
        return unlink($path);
    }

    return false;
}



?>