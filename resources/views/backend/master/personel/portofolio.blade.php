<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Portofolio</title>
<meta name="description" content="">

<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
<!--Style-->
<link rel="stylesheet" href="{{ asset(null) }}frontend/css/reset.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css">
<link rel="stylesheet" href="{{ asset(null) }}frontend/css/portofolio.css">
</head>
<body>
<!--[if lt IE 7]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]--> 

<!-- header -->

<!-- end of header -->
<!-- middle -->
<div id="portofolio-content">
    <div class="box-paper">
        <div class="pen"><img src="{{ asset(null) }}frontend/images/material/pen.png"></div>
        <div class="top-porto">
            <div class="left-top">
                <h1 class="name">{{$model->name}}</h1>
                <p class="title"><i>{{$model->birthplace}}, {{$model->dob}}</i></p>
            </div>
            <div class="right-top">
                <address>
                  <strong>Twitter, Inc.</strong><br>
                  {{$model->address}}<br>
                  <abbr title="Phone">P:</abbr> {{$model->phone}}
                </address>
            </div>
        </div><!--end.top-porto-->
        <div class="bottom-porto">
            <div class="left-bottom">
                <div class="left-rows">
                    <h3 class="sub-title">Profesional Profile</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin fermentum hendrerit arcu ut eleifend. Vestibulum pulvinar eros at diam scelerisque facilisis sed et arcu. Ut laoreet finibus mi ac ultricies. Donec vitae dictum mi, non placerat dolor.</p>
                </div>
                <div class="left-rows">
                    <h3 class="sub-title">Experience</h3>
                    <p>{{$model->experience}}</p><br>
                </div>
                <div class="left-rows">
                    <h3 class="sub-title">Experience</h3>
                        <div class="col2">
                            <p><strong>Name, surname<br>Position title</strong></p>
                            <p>12355674i294 <br> Akun@mail.com<p>
                        </div>
                        <div class="col2">
                            <p><strong>Name, surname<br>Position title</strong></p>
                            <p>12355674i294 <br> Akun@mail.com<p>
                        </div>
                </div>
            </div><!--end.left-bottom-->
            <div class="right-bottom">
                <div class="right-rows social-row">
                    <h3 class="sub-title">Social</h3>
                    <p><i class="fa fa-facebook-square" aria-hidden="true"></i> facebook</p>
                    <p><i class="fa fa-twitter-square" aria-hidden="true"></i> Twitter</p>
                    <p><i class="fa fa-linkedin-square" aria-hidden="true"></i> Linkedin</p>
                    <p><i class="fa fa-skype" aria-hidden="true"></i> Skype</p>
                    <p><i class="fa fa-instagram" aria-hidden="true"></i> Instagram</p>
                </div>
                <div class="right-rows">
                    <h3 class="sub-title">Education</h3>
                    <p>{{$model->education}}</p>
                </div>
                <div class="right-rows social-row">
                    <h3 class="sub-title">Skills</h3>
                    <p>Lorem Ipsum Dolor sit amet</p>
                    <p>Lorem Ipsum Dolor sit amet</p>
                    <p>Lorem Ipsum Dolor sit amet</p>
                    <p>Lorem Ipsum Dolor sit amet</p>
                    <p>Lorem Ipsum Dolor sit amet</p>
                    <p>Lorem Ipsum Dolor sit amet</p>
                </div>
                <div class="right-rows social-row">
                    <h3 class="sub-title">Awards</h3>
                    <p><strong>2014 - Present <br> Achievment title</strong><br>Company name, location</p>
                    <p><strong>2014 - Present <br> Achievment title</strong><br>Company name, location</p>
                </div>
            </div><!--end.right-bottom-->
        </div>
    </div>
</div>
<!-- end of middle -->

<!--Footer -->

<!--end of Footer -->
</body>
</html>