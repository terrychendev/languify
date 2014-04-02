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
                        @foreach ( $all_languages as $language )
                            <button class="btn btn-default" data-lang-code="{{ $language->code }}"> 
                                {{ strtoupper($language->code) }} 
                            </button>
                        @endforeach
                        <button class="btn btn-success" id="filter-languages">
                            <i class="fa fa-filter fa-lg"></i> Filter
                        </button>
                    </div>
                </div><!--/.navbar-collapse -->
            </div>
        </div>

        <div class="jumbotron">
            <div class="container">
                <img class="img-circle pull-left" width="17.5%" src="/assets/img/nerds.jpg">
                <h1>
                    Nerds getting started
                </h1>
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
                            @foreach( $languages as $language )
                                <th title="{{ ucfirst($language->name) }}" data-langID="{{ $language->id }}">
                                    {{ strtoupper($language->code) }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $words as $word )                             
                            <tr>
                                @foreach ( $languages as $language )
                                    <td data-wordID="{{ $word->id }}" data-languageID="{{ $language->id }}">
                                    @if ( $language->code == 'en' )
                                        {{-- Just print the english word --}}
                                        {{ $word->word }}
                                    @elseif ( isset($translations[$word->id][$language->id]) )
                                        {{-- This word has a translation in this language, print it --}}
                                        {{ $translations[$word->id][$language->id] }}
                                    @else
                                        {{-- This word does not have a translation in this language, do nothing --}}
                                    @endif
                                    </td>
                                @endforeach     
                            </tr>
                        @endforeach
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
        <script> var words = {{ json_encode($words) }} </script>
        <script src="/assets/js/main.js"></script>
        <script src="/assets/js/app.js"></script>
    </body>
</html>




