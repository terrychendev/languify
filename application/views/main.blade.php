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
        <link rel="stylesheet" href="/assets/css/toastr.min.css"/>
        <link rel="stylesheet" href="/assets/css/main.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        <div class="jumbotron">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 text-center">
                        <img class="img-circle" width="100%" src="/assets/img/nerds.jpg">
                    </div>
                    <div class="col-md-10">
                        <h1>Nerds getting started</h1>
                        <p>
                            YOLO. Swag. Languify v0.1.
                            @foreach ( $all_languages as $language )
                                <button class="btn btn-default" data-lang-code="{{ $language->code }}"> 
                                    {{ strtoupper($language->code) }} 
                                </button>
                            @endforeach
                            <button class="btn btn-success" id="filter-languages">
                                <i class="fa fa-filter fa-lg"></i> Filter
                            </button>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
             <div class="table-responsive">
                <div class="row">
                    <div class="col-md-8">
                        <i class="fa fa-plus-square fa-2x"> Add New Words</i>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="search-box" placeholder="Search words ...">
                    </div>                    
                </div>

                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            @foreach( $languages as $language )
                                <th class="col-sm-2" title="{{ ucfirst($language->name) }}" data-languageID="{{ $language->id }}">
                                    {{ strtoupper($language->code) }}
                                </th>
                            @endforeach
                            <th>Tag</th>
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
                                <td>fy-{{ $word->tag }}</td>
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
        <script src="/assets/vendor/datatables/media/js/jquery.dataTables.min.js"></script>
        <script src="/assets/js/toastr.min.js"></script>
        <script src="/assets/js/main.js"></script>
        <script src="/assets/js/app.js"></script>
    </body>
</html>




