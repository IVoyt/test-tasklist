<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" http-equiv="content-type" content="text/html">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="<?=$css_dir?>bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?=$css_dir?>style.css">
        <link rel="stylesheet" type="text/css" href="<?=$css_dir?>font-awesome.css">
        <title>TaskList</title>
    </head>

    <body>

        <div id="main" class="container-fluid">

            <nav class="navbar">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/">TaskList</a>
                    </div>
                </div>
            </nav>


            <div class="container-fluid text-center">
                <div class="row content">
                    <div class="col-lg-12 text-left">


                        <?php
                            /**
                             *  render view
                             */
                            echo $body_content;
                        ?>

                    </div>
                </div>
            </div>

            <footer class="container-fluid text-center">
                <p>&copy 2018 | Igor Voytovich</p>
                <a href="/admin/main">admink@</a>
            </footer>

        </div>



        <script src="<?=$js_dir?>jquery-3.3.1.min.js"></script>
        <script src="<?=$js_dir?>bootstrap.min.js"></script>
        <script src="<?=$js_dir?>custom.js"></script>
    </body>
</html>
