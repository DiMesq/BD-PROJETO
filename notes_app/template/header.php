<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notify</title>

     <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/bootstrap-social.css" rel="stylesheet">
    <!-- Font-awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom styling -->
    <link href="css/mystyles.css" rel="stylesheet">

</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Notify</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <?php if (!empty(SESSION["id"])): ?>
                        <li class="active"><a href="#"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>   Home</a></li>
                        <li><a href="#"><i class="fa fa-folder"></i> Types</a></li>
                            </ul>
                        </li>
                        <li><a href="#"><i class="fa fa-clone"></i> Pages</a></li>
                    <?php endif; ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (empty(SESSION["id"])): ?>
                        <li><a href="#"></i> Login</a></li>
                        <li><a href="#"></i><Strong> Register</Strong></a></li>
                    <?php else: ?>
                        <li><a href="#"><i class="fa fa-sign-out"></i> Logout</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
