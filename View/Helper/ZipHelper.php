<?php
class ZipHelper extends AppHelper {
  public function create($files = array()) {
    $folder = 'files/';
    $destination = tempnam('tmp/', "zip");

    $validFiles = array();
    if (is_array($files)) {
      foreach ($files as $file) {
        if (file_exists($folder.$file)) {
          $validFiles[] = $folder.$file;
        }
      }
    }
    // debug($files);

    if (count($validFiles) < 1) {
      return false;
    }

    $zip = new ZipArchive();
    if ($zip->open($destination, ZipArchive::OVERWRITE) !== true) {
      return false;
    }

    $dest = 'hackdomia_download';
    foreach ($validFiles as $file) {
      $zip->addFile($file, $dest.DS.basename($file));
    }
    $zip->close();

    if (file_exists($destination)) {
      return $destination;
    } ;
  }
}