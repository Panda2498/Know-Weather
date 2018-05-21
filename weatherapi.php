<?php
$weather="";
$error="";
if($_GET['city'])
{
    $city = str_replace(' ','',$_GET['city']);
    $urlContents=file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$city."&appid=2cecaca6155cb0d78ec244d24371187a");

    $weatherArray = json_decode($urlContents, true);

    if($weatherArray['cod'] == 200)
    {
        $weather = "The weather in ".$_GET['city']." is currently ".$weatherArray['weather'][0]['description'].".";

        $tempInCelsius = intval($weatherArray['main']['temp']-273);
        $weather .= " The temperature is ".$tempInCelsius."&deg;C and the wind speed is ".$weatherArray['wind']['speed']."m/s.";
    }
    else
    {
      $error = "This city could not be found. Please try again!";
    }

}

?>





<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <title>Weather Scrapper</title>
    <style type="text/css">
    html
    {
      background: url(wim.jfif) no-repeat center center fixed;
      -wekbkit-background-size:cover;
      -o-background-size:cover;
      -moz-background-size:cover;
      background-size: cover; 
    }
    body
    {
      background:none;
    }
    .container
    {
      text-align: center;
      margin-top:200px;
      width:450px;
    }
    input
    {
      margin:20px 0;
    }
    #weather
    {
      margin-top:15px;
    }
  </style>
  </head>
  <body>
    
    <div class="container">
      <h1> What's The Weather? </h1>
      

      <form>
  <div class="form-group">
    <label for="city">Enter the name of a city.</label>
    <input type="text" class="form-control" name="city" id="city" placeholder="Eg. London, Paris" value="<?php echo $_GET['city']; ?>">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<div id="weather">
  <?php
    if($weather)
    {
      echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
    }

    else if($error)
    {
      echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
    }
  ?>
</div>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>