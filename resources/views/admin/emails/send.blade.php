<!DOCTYPE html>
<html>
<head>
 <title>Email from Icheck</title>
 <style>
     .mail-wrap {
        text-align: center;
        margin: 0 auto;
     }
     header {
        padding: 15px;
        background-color: aliceblue;
        box-shadow: 0px 4px 2px #d5d0d0;
        border-bottom: 1px solid #dbd2d2;
        background-image: url('/images/logo.png');
        background-repeat: no-repeat;
        background-position: left center;
     }
     h2 {
        color: darkslategrey;
     }

     main {
        text-align:center;
        padding:30px 15px;
        width: 80%;
        margin: 0 auto;
        color: #4d4e4e;
     }
     h4 {
         font-weight: 600;
     }
     .body {
         margin-bottom: 20px;
         min-height: 300px;
         position: relative;
     }

     .body p {
         margin: 5px;
         font-size: 18px;
     }

     a {
        font-weight: 600;
        color: #f54040;
        text-decoration: none;
     }
     a:hover {
        color: #e08e26;
     }

     a.subs-activate {
        background-color: #1d9005;
        padding: 10px 15px;
        display: block;
        width: 100px;
        margin: 10px auto;
        font-size: 16px;
        letter-spacing: 1px;
        border: 1px solid;
        color: white;
     }

     .unsubscribe-wrap {
         margin-top: 50px;
         padding: 15px;
         border-top: 1px dotted #ababab;

     }

     .post-title {
         color: #4d4e4e;
         text-decoration: underline dotted;
     }

     a.subs-deactivate {
        background-color: #f54040;
        padding: 7px 21px;
        display: block;
        width: 100px;
        margin: 10px auto 15px;
        font-size: 16px;
        letter-spacing: 1px;
        border: 1px solid;
        color: white;
     }

     .body .answer {
        box-shadow: inset 0px 0px 9px 0px grey;
        margin: 15px auto;
        padding: 15px;
     }

     footer {
        background-color: #bfbfbf;
        padding: 15px;
        font-size: 13px;
        font-family: sans-serif;
        border-top: 1px solid gray;
        box-shadow: 0px -2px 3px #ababab;
     }
 </style>
</head>
<body>

    <div class="mail-wrap" style="text-align: center">
            <header>
                <h1>Icheck.am</h1>
            </header>
            <main>
                <div class="body">
                    {!! $body !!}
                </div>
            </main>
            <footer>
                <p>© {{date('Y')}} Icheck.am. All rights reserved.</p>
            </footer>
    </div>

</body>
</html>
