<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">        
        <title>First Task</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">        
    </head>
    <body>
        <header>
            <div class="container">
                <span class="header_text applicant">Suren Melyan</span>
                <span class="header_text task">Task N1</span>
            </div>
        </header> 
        @if (Session::has('error'))       
            <div class="alert alert-danger errors">
                <strong>Warning!</strong> {!! session('error') !!}
            </div>        
        @endif
         @if (Session::has('success'))        
            <div class="alert alert-success errors">
                <strong>Warning!</strong> {!! session('success') !!}
            </div>       
        @endif
     
        <div class="container">
            <div class="row">
                <div class="search">
                    {{ Form::open(array('url' => 'searchHuman', 'files'=> 'true')) }}
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                         {!! Form::text('search_first_name', null, array('placeholder'=>'Search By First Name', 'class' =>  'form-control')) !!}
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                         {!! Form::text('search_last_name', null, array('placeholder'=>'Search By Last Name', 'class' =>  'form-control')) !!}
                    </div>
                    <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
                         {!! Form::text('search_keyword', null, array('placeholder'=>'Search By Keyword(s)', 'class' =>  'form-control')) !!}
                    </div>
                    {!! Form::submit('Search now', array('class' => 'btn btn-primary')) !!}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="container">
            <div class="addHuman">
                {{ Form::open(array('url' => 'addHuman', 'files'=> 'true')) }}
                    <div class="form-group">
                        @if ($errors->has('first_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                        {!! Form::text('first_name', null, array('placeholder'=>'Enter Your First Name', 'class' =>  'form-control', 'required')) !!}
                    </div>
                    <div class="form-group">
                    @if ($errors->has('last_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                        {!! Form::text('last_name', null, array('placeholder'=>'Enter Your Last Name', 'class' =>  'form-control', 'required')) !!}
                    </div>
                    <div class="form-group">
                        @if ($errors->has('keyword'))
                            <span class="help-block">
                                <strong>{{ $errors->first('keyword') }}</strong>
                            </span>
                        @endif                        
                        {!! Form::text('keyword', null, array('placeholder'=>'Keyword(s)', 'class' =>  'form-control', 'required')) !!}
                    </div>
                    <div class="form-group">
                        @if ($errors->has('file'))
                            <span class="help-block">
                                <strong>{{ $errors->first('file') }}</strong>
                            </span>
                        @endif
                        {{ Form::label('file','Upload CV',array('id'=>'','class'=>'btn btn-default form-control')) }}
                        {{ Form::file('file','',array('id'=>'','class'=>'fileupload')) }}
                    </div>
                    <div class="form-group center">
                        {!! Form::submit('Add Person', array('class' => 'btn btn-primary')) !!}
                    </div>
                    {!! csrf_field() !!}
                {{ Form::close() }}
            </div>
            @if(isset($result))            
            <table id="people" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Keyword(s)</th>
                        <th>CV</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($result as $info)                  
                    <tr>
                        <td>{{$info->id}}</td>
                        <td>{{$info->first_name}}</td>
                        <td>{{$info->last_name}}</td>
                        <td>{{$info->keywords}}</td>
                        <td><a href="download/{{$info->cv}}" target="_blank">Download</a></td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
            @endif  
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.bootstrap.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>
