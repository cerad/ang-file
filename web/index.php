<?php

?>
<!DOCTYPE html>
<html lang="en" ng-app="CeradFileApp" ng-strict-di>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>File</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="/">
    <link rel="stylesheet" type="text/css" href="css/vendor.css">
  </head>
  <body>
    <file-download url="download.php/xxx" filename="test2.txt"></file-download>
    <hr>
    <a href="data:text/plain;charset=utf-8,test%20contents%0D%0Ago%20here" download="Test">Saveable</a>
    <hr>
    <div ng-app="fileUpload" ng-controller="CeradFileUploadController">
      watching model:<br>
      <div class="btn btn-primary" ng-file-select ng-model="files">Upload using model $watch</div>
      <div class="button" ng-file-select ng-file-change="upload($files)">Upload on file change</div>
      Drop File:
      <div ng-file-drop ng-model="files" class="drop-box" 
        drag-over-class="dragover" ng-multiple="true" allow-dir="true"
        accept=".jpg,.png,.pdf">Drop Images or PDFs files here</div>
      <div ng-no-file-drop>File Drag/Drop is not supported for this browser</div>
    </div>
    <script src="js/vendor.js"></script>
    <script src="app.js"></script>
    <script>
      // Seems to work okay, even in IE10
      //var blob = new Blob(["Hello, world!"], {type: "text/plain;charset=utf-8"});
      //saveAs(blob, "hello_world.txt");
    </script>
  </body>
</html>
  