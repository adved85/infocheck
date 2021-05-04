    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="keywords" content="{{__('text.app_description')}}" />
    <meta name="description" content="{{__('text.app_keywords')}}">



    <link rel="stylesheet" href="/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="/style.css" type="text/css">
    <link rel="stylesheet" href="/css/swiper.css" type="text/css">
    <link rel="stylesheet" href="/css/dark.css" type="text/css">
    <link rel="stylesheet" href="/css/font-icons.css" type="text/css">
    <link rel="stylesheet" href="/css/animate.css" type="text/css">
    <link rel="stylesheet" href="/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="/css/responsive.css" type="text/css">
    <link rel="stylesheet" href="/css/greedyNav.css">
    <link rel="stylesheet" href="/css/fullcalendar.min.css">
    <link rel="icon" type="image/x-icon" href="/images/logo.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style id="fit-vids-style">.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style>

    <link rel="stylesheet" href="/css/background.css">
    <link rel="stylesheet" href="/css/inp.css">
    <link rel="stylesheet" href="/css/index_layouts.css">
    @if (app()->getLocale() == 'am')
    {{-- @dump('hey') --}}
    <link rel="stylesheet" href="/css/armenian-font.css" type="text/css">
    @else
    {{-- <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i" rel="stylesheet" type="text/css"> --}}
    <link rel="stylesheet" href="/css/other-langs.css" type="text/css">
    @endif

<style>

#loading {
    position: fixed;
    width: 100%;
    height: 100%;
    /* background-color: #000000a8; */
    background-color: #ffffff;
    color: white;
    font-size: 30px;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
    /* position: absolute; */
    overflow: hidden;
    top: 0;
    left: 0;
}

#loading h1 {
    position: absolute;
    left: 50%;
    top: 50%;
    z-index: 1;
    width: 150px;
    height: 150px;
    margin: -75px 0 0 -75px;
    border: 16px solid #e8e8e8;
    border-radius: 50%;
    border-top: 16px solid #404b6f;
    width: 120px;
    height: 120px;
    -webkit-animation: spin 1s linear infinite;
    animation: spin 1s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 }
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom {
  from{ bottom:-100px; opacity:0 }
  to{ bottom:0; opacity:1 }
}

#loaded {
    /* display: none; */
}

body {
    overflow: hidden;
}


</style>
