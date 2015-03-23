<!DOCTYPE html>
<html lang="en">
<head>
  <title>URL Shortener</title>
  <link rel="stylesheet" href="/assets/css/styles.css" />
</head>
<body>
<div id="container">

  <!-- Errors display -->
  @if(Session::has('errors'))
    <h3 class="error">{{$errors->first('link')}}</h3>
  @endif

  <!-- Message koji prosledjumemo iz Route -->
  @if(Session::has('message'))
    <h3 class="error">{{Session::get('message')}}</h3>
  @endif


  <h2>Uber-Shortener</h2>
  {{Form::open(array('url'=>'/','method'=>'post'))}}

  {{Form::text('link',Input::old('link'),
    array('placeholder'=>
    'Insert your URL here and press enter!'))}}
    {{Form::close()}}

  <!-- Ukoliko je generisan link -->
  @if(Session::has('link'))
  <br>
  <h3 class="success">
    {{ link_to(Session::get('link'), "Click here for your shortened URL") }}
  </h3>
  @endif
</div>
</body>
</html>
