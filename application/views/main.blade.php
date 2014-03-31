<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/assets/img/favicon.ico" type="image/x-icon">
        <title>Languify</title>
        <meta name="description" content="Global languages as easy as Font Awesome">
        <meta name="viewport" content="width=device-width">
        
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/qtip2/2.2.0/basic/jquery.qtip.min.css">
        
        <link rel="stylesheet" href="/assets/css/main.css">
        <link rel="stylesheet" href="/library/en.css" class="language-loader">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">
                        Languify
                    </a>
                </div>
                <div class="navbar-collapse collapse">
                    <div class="navbar-form navbar-right">
                        <button class="btn btn-default" data-langcode="en"> EN </button>
                        <button class="btn btn-default" data-langcode="es"> ES </button>
                        <button class="btn btn-default" data-langcode="fr"> FR </button>
                        <button class="btn btn-default" data-langcode="zh"> ZH </button>
                    </div>
                </div><!--/.navbar-collapse -->
            </div>
        </div>

        <div class="jumbotron">
            <div class="container">
                <h1>Getting started</h1>
                <p>
                    YOLO. Swag. Languify v0.1.
                </p>
            </div>
        </div>

        <div class="container">
            <div class="table-responsive">
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Display Text</th>
                            <th>HTML</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="lf lf-login"></span></td>
                            <td>&lt;span class="lf lf-login"&gt;&lt;/span&gt;</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Footer -->
            <footer>
                <hr>
                <p>&copy; Languify v0.1 - <?= date("Y"); ?></p>
            </footer><!-- /.footer -->
        </div><!-- /container -->
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/qtip2/2.2.0/basic/jquery.qtip.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <script src="/assets/js/main.js"></script>
    </body>
</html>




