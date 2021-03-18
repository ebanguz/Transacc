<?php

class Layout {

 private $isPage;
 private $directory;

 function __construct($page) {

  $this->isPage = $page;
  $this->directory = ($this->isPage) ? "../" : "";

 }

 public function printHeader() {

  $header = <<<EOF
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Registro</title>

        <link href="{$this->directory}assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{$this->directory}assets/css/style.css">
    </head>

    <body>
        <header>
            <div class="navbar navbar-dark bg-dark shadow-sm">
                <div class="container d-flex justify-content-between">
                    <a href="{$this->directory}index.php" class="navbar-brand d-flex align-items-center">
                        <strong>Registro</strong>
                    </a>

                </div>
            </div>
        </header>
    EOF;

  echo $header;
 }

 public function printFooter() {

  $footer = <<<EOF
        <footer class="text-muted">
        <div class="container">
            <p class="float-right">
                <a href="#">Volver arriba</a>
            </p>
            <p>EGA</p>

        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <script src="{$this->directory}assets/js/bootstrap.min.js">
    </script>

    <div id="weava-permanent-marker" date="1603938382626"></div>
    <div id="weava-ui-wrapper">
        <div class="weava-drop-area-wrapper">
            <div class="weava-drop-area"></div>
            <div class="weava-drop-area-text">Drop here!</div>
        </div>
    </div>
    </body>

    </html>
EOF;

  echo $footer;
 }
}

?>