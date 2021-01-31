<?php

session_start();
include("connection.php");
include("function.php");

if($_SERVER['REQUEST_METHOD']=="POST"){
    $user_name=$_POST['user_name'];
    $password=$_POST['password'];
    $conform_password=$_POST['conform_password'];


    if(filter_var($user_name, FILTER_VALIDATE_EMAIL) && !empty($user_name) &&! empty($password) && !empty($conform_password) && !is_numeric($user_name) ){
        if($password == $conform_password){
            
            $checkQuery="select * from logintable where username = '$user_name' limit 1";
            $result =mysqli_query($con,$checkQuery);
            if($result && mysqli_num_rows($result)>0){
                echo '<script>window.alert("Mail-Id already used")</script>';     
        }else{

            //save to database
            
            
            $user_id =random_num(20);
            $query="insert into logintable (user_id,username,password) values('$user_id','$user_name','$password')";
            mysqli_query($con, $query);

            header("Location: login.php");
            die;

        }
            

        }else{
           echo '<script>window.alert("Password is not matching")</script>';    
        }
    }else{
        echo '<script>alert("Please enter some valid information")</script>'; 
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">

        <script type="text/javascript" src="paper-full.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.0/howler.js"></script>
        
        <link rel="stylesheet" type="text/css" href="circles.css">
        <link href='https://css.gg/play-button.css' rel='stylesheet'>


        <script type="text/paperscript" canvas="myCanvas"> 
            
            var keyData={
                q:{
                    color:"purple",
                    sound:new Howl({
                        src: ['sounds/bubbles.mp3']
                      })
                },
                w:{
                    color:"red",
                    sound:new Howl({
                        src: ['sounds/clay.mp3']
                      })
                },
                e:{
                    color:"green",
                    sound:new Howl({
                        src: ['sounds/confetti.mp3']
                      })
                },
                r:{
                    color: '#9b59b6',
                    sound: new Howl({
                        src: ['sounds/corona.mp3']
                      })
                      
                },
                t: {
                sound: new Howl({
                    src: ['sounds/dotted-spiral.mp3']
                }),
                color: '#34495e'
            },
            y: {
                sound: new Howl({
                    src: ['sounds/flash-1.mp3']
                }),
                color: '#16a085'
            },
            u: {
                sound: new Howl({
                    src: ['sounds/flash-2.mp3']
                }),
                color: '#27ae60'
            },
            i: {
                sound: new Howl({
                    src: ['sounds/flash-3.mp3']
                }),
                color: '#2980b9'
            },
            o: {
                sound: new Howl({
                    src: ['sounds/glimmer.mp3']
                }),
                color: '#8e44ad'
            },
            p: {
                sound: new Howl({
                    src: ['sounds/moon.mp3']
                }),
                color: '#2c3e50'
            },
            a: {
                sound: new Howl({
                    src: ['sounds/pinwheel.mp3']
                }),
                color: '#f1c40f'
            },
            s: {
                sound: new Howl({
                    src: ['sounds/piston-1.mp3']
                }),
                color: '#e67e22'
            },
                d: {
                sound: new Howl({
                    src: ['sounds/piston-2.mp3']
                }),
                color: '#e74c3c'
            },
            f: {
                sound: new Howl({
                    src: ['sounds/prism-1.mp3']
                }),
                color: '#95a5a6'
            },
            g: {
                sound: new Howl({
                    src: ['sounds/prism-2.mp3']
                }),
                color: '#f39c12'
            },
            h: {
                sound: new Howl({
                    src: ['sounds/prism-3.mp3']
                }),
                color: '#d35400'
            },
            j: {
                sound: new Howl({
                    src: ['sounds/splits.mp3']
                }),
                color: '#1abc9c'
            },
            k: {
                sound: new Howl({
                    src: ['sounds/squiggle.mp3']
                }),
                color: '#2ecc71'
            },
            l: {
                sound: new Howl({
                    src: ['sounds/strike.mp3']
                }),
                color: '#3498db'
            },
            z: {
                sound: new Howl({
                    src: ['sounds/suspension.mp3']
                }),
                color: '#9b59b6'
            },
            x: {
                sound: new Howl({
                    src: ['sounds/timer.mp3']
                }),
                color: '#34495e'
            },
            c: {
                sound: new Howl({
                    src: ['sounds/ufo.mp3']
                }),
                color: '#16a085'
            },
            v: {
                sound: new Howl({
                    src: ['sounds/veil.mp3']
                }),
                color: '#27ae60'
            },
            b: {
                sound: new Howl({
                    src: ['sounds/wipe.mp3']
                }),
                color: '#2980b9'
            },
            n: {
                sound: new Howl({
                    src: ['sounds/zig-zag.mp3']
                }),
                color: '#8e44ad'
            },
            m: {
                sound: new Howl({
                    src: ['sounds/moon.mp3']
                }),
                color: '#2c3e50'
            }
                
            }
            var circles=[];
            function onKeyDown(event){
                if(keyData[event.key]){
                    keyData[event.key].sound.play();
                    var maxPoint=new Point(view.size.width,view.size.height);
                    var randomPoint=Point.random();
                    var point=maxPoint*randomPoint;
                    var newCircles=new Path.Circle(point, 400);
                    newCircles.fillColor=keyData[event.key].color;
                    circles.push(newCircles);
                }

            }
            function onFrame(event){
                for(var i=0;i<circles.length;i++){
                    circles[i].fillColor.hue+=1;
                    circles[i].scale(.9);
                }
            }
            var canvas = document.getElementById("myCanvas");
            


        </script>
</head>
<body>
<canvas id="myCanvas" resize>            
            </canvas>
    <div class="wrapper">
        <h1>The sound of Sign-Up</h1>
        <form  method="post">
            <input type="text" name="user_name" placeholder="E-mail">
            <input  type="password" name="password" placeholder="Password">
            <input  type="password" name="conform_password" placeholder="Retype Password">
            <input type="submit" value="Register">
        </form>
        
        <div class="socials2">
            
            <a id="JustRight" href="login.php">Already have an account Sign-In ?</a>
        </div>
    </div>
    <div id="overlay-area"></div>
</body>
</html>