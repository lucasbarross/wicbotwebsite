<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>WIC? Discord bot</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">
        $(document).ready(function(){
            $("#btn_ideas").click(function(){
                $.ajax({
                    url: 'idea_sender.php',
                    method: 'post',
                    data: $('#formIdeas').serialize(),
                    success: function(data){
                        if(data.substring(0, 7) !== "Invalid"){
                            $('#nome').val("");
                            $('#representacao').val("");
                        }
                        $('#statusSubmission').html(data);
                    }
                })
            })
        })
    </script>

  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top menu">
        <div class="container">
            <div class="navbar-header">
                <a href="#" style="background:url(img/logo.png); width:180px; height:50px; background-repeat: no-repeat;"class="navbar-brand"></a>
            </div>
            <div>
                <ul id="menu" class="nav navbar-nav" style="margin-left:18%;">
                    <li class="active"> <a href="#about">about</a> </li>
                    <li> <a href="#ideias">send ideas</a> </li>
                    <li> <a href="#statistics">statistics</a> </li>
                    <li class="invite-button"> <a target="_blank" href="https://discordapp.com/oauth2/authorize?client_id=302157734613221376&scope=bot&permissions=8192"><span style="color: white;">invite</a> </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <section id="about">
        <div class="container content">
            <div class="row">
                <div class="col-md-12"><h1 class="text-center text-uppercase"><strong>Test your League of Legends' knowlegde!</strong></h1></div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6"><p class="text-center text-justify about-text">'Who is that champion?' is a discord minigame bot. Your objective is to guess which League of Legends champion the bot meant to represent by the standard emojis of Discord. It already covers 71 League of Legends' champions representations and intends to grow.</p></div>
                <div class="col-md-3"></div>
            </div>
            <div class="row">
                
                <div class="col-md-6">
                    <a target="_blank" href="https://www.github.com/lucasbarross/dcbot">
                        <button type="button" style="max-width: 150px;" class="btn btn-default pull-right btn-purple">GitHub</button>
                    </a>
                </div>
                <div class="col-md-6">
                    <a target="_blank" href="https://discordapp.com/oauth2/authorize?client_id=302157734613221376&scope=bot&permissions=8192">
                        <button type="button" style="max-width: 150px;" class="btn btn-default pull-left btn-rounded-blue">Invite</button>
                    </a>
                </div>
             
            </div>
        </div>
    </section>
    
    <section id="ideias">
        <div class="container content">
            <div class="row">
                <div class="col-md-12"><h1 class="text-center text-uppercase"><strong>Want to help us?</strong></h1></div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6"><p class="text-center idea-text">Submit your champion representation idea!</p></div>
                <div class="col-md-3"></div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                 <div class="col-md-4">
                    <form id="formIdeas">
                        <div class="form-group">
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Champion name. Ex: Teemo">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="representacao" name="representacao" placeholder="Champion representation. Ex: :mushroom:">
                            <small class="form-text text-muted helper-text"><strong>Champions that already exists will be considered to change.</strong></small>
                        </div>
                        <button type="button" id="btn_ideas" class="btn btn-default btn-rounded center-block">SUBMIT</button>
                        <div id="statusSubmission" class="helper-text text-center"></div>
                    </form>                    
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </section>

    <section id="statistics">
        <div class="container content">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center text-uppercase"><strong>HOW ARE THE PLAYERS DOING, YOU ASK...</strong></h1>
                </div>           
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4" style="background-color: rgba(61,149,105,0.1); padding: 50px;">
                    <div class="chart-container">
                        <canvas id="submissionsChart"></canvas>
                    </div>
                </div>  
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div id="hardest-champion" class="champion-hardest center-block">
                        <img style="max-width:80px; opacity: 0.8;" src=http://ddragon.leagueoflegends.com/cdn/6.24.1/img/champion/Jayce.png> <strong style="margin-left:20px; text-shadow: 2px 2px rgba(0,0,0,0.1);">HARDEST CHAMPION</strong> with 6.4% correct answers.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="easiest-champion" class="champion-easiest center-block">
                        <img style="max-width:80px; opacity: 0.8;"src=http://ddragon.leagueoflegends.com/cdn/6.24.1/img/champion/Annie.png> <strong style="margin-left:20px; text-shadow: 2px 2px rgba(0,0,0,0.1);">EASIEST CHAMPION</strong> with 73.6% correct answers.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        Bot and website developed by <a target="_blank" href="https://cin.ufpe.br/~lbam">Lucas Barros</a> | Art made by CakeSake
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="js/pieceLabel.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>