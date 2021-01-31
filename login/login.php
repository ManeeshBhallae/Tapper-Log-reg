<?php
session_start();
include("connection.php");
include("function.php");

if($_SERVER['REQUEST_METHOD']=="POST"){
    $user_name=$_POST['user_name'];
    $password=$_POST['password'];
    if(!empty($user_name) &&! empty($password) && !is_numeric($user_name) ){

            //read to database
            $query="select * from logintable where username = '$user_name' limit 1";
            
            $result = mysqli_query($con, $query);

            if($result){
                if($result && mysqli_num_rows($result)>0){
                    $user_data=mysqli_fetch_assoc($result);
                    if($user_data['password']=== $password){
                        $_SESSION['user_id']=$user_data['user_id'];
                        header("Location: index.php");
                        die;
                    }else{
                        echo '<script>alert("Username or password is not right")</script>'; 
                    }
                }else{echo '<script>alert("No such Mail-id is present")</script>'; }
            }else{
                 echo '<script>alert("Data retrival from db failed")</script>'; 
            }   
    }else{
        echo '<script>alert("Please enter some valid information")</script>';
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <script type="text/javascript" src="paper-full.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.0/howler.js"></script>
        
        <link rel="stylesheet" type="text/css" href="circles.css">
        <link href='https://css.gg/play-button.css' rel='stylesheet'>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="style.css">

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
        <h1>The sound of Sign-In</h1>
        <form method="post">
            <input type="text" name="user_name" placeholder="E-mail">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" value="Login">
        </form>
        <div class="bottom-text">

            <a href="signUp.php">Not yet a member Sign-Up ?</a>
        </div>
        <div class="bottom-text">
            <br>
            <br>
            <input type="checkbox" name="remember" checked="checked">Remember me
        </div>
    </div>


   
            
            
        </body>
</html>