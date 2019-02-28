<?php
function signup(){
  $sql = "insert into user values('".$_POST['signup_username']."','".$_POST['signup_fname']."','".$_POST['signup_lname']."','".$_POST['age']."','".hashed($_POST['new_password'])."')";
  if(set_data($sql)){
      echo "<script>window.location='index.php'</script>";
  }
}
function login(){
    $sql= "select password from user where username='".$_POST['login_username']."'";
    $result=get_data($sql);
    $user = mysqli_fetch_assoc($result);
    if($user['password']==hashed($_POST['login_password'])){
        $_SESSION['username']=$_POST['login_username'];
       
        echo "<script>window.location='index.php'</script>";
    }else{
        echo "<div class='alert alert-danger'>Invalid Credentials.</div>";
    }
}
function signout(){
    unset($_SESSION['username']);
    echo "<script>window.location='index.php'</script>";
}
function hashed($password){
    $hashedpass=sha1(md5($password));
    return $hashedpass;
}
function all_movies(){
    $sql  = "select Movie_id,name,coverimage from moviedetails";
    $movies=get_data($sql);
    $count=0;
    echo "<tr><td colspan='3'><h1>All Movies</h1><hr></td></tr><tr>";
    while($movie=mysqli_fetch_assoc($movies)){
        if($count%3==0){
            echo "</tr><tr>";
        }
        echo "<td><a href='index.php?movieid=".$movie['Movie_id']."'><img src='../coverimage/".$movie['coverimage']."'></a><br>".$movie['name']."<td>";
        $count++;
    }
}
function movies_by_genere(){
    $sql = "select Movie_id,name,coverimage from moviedetails where genere like '%".$_GET['genere']."%'";
    $movies=get_data($sql);
    $count=0;
    echo "<tr><td colspan='3'><h1>".strtoupper($_GET['genere'])." Movies</h1><hr></td></tr><tr>";
    while($movie=mysqli_fetch_assoc($movies)){
        if($count%3==0){
            echo "</tr><tr>";
        }
        echo "<td><a href='index.php?movieid=".$movie['Movie_id']."'><img src='../coverimage/".$movie['coverimage']."'></a><br>".$movie['name']."<td>";
        $count++;
    }
}
function search_movie(){
    $sql = "select Movie_id,name,coverimage from moviedetails where name like '%".$_POST['moviename']."%'";
    $count=0;
    $movies=get_data($sql);
    echo "<tr>";
    while($movie=mysqli_fetch_assoc($movies)){
        if($count%3==0){
            echo "</tr><tr>";
        }
        echo "<td><a href='index.php?movieid=".$movie['Movie_id']."'><img src='../coverimage/".$movie['coverimage']."'></a><br>".$movie['name']."<td>";
        $count++;
    }
}
function show_movie(){
    $sql  = "select  * from moviedetails where Movie_id='".$_GET['movieid']."'";
    
    $movies=get_data($sql);
    $movie=mysqli_fetch_assoc($movies);
    echo "<tr><td valign='top' colspan='3'><h1>".$movie['name']."</h1><hr></td></tr><tr>
    <td valign='top' rowspan='8'><img src='../coverimage/".$movie['coverimage']."'></td>";
    foreach($movie as $key=>$value){
        if($key=='coverimage'||$key=='Movie_id'){

        }else{
            echo "<td><Strong>".$key."</Strong><br>".$value."</td></tr><tr>";
        }
    }
    echo "<td><a href='index.php'>Go back to Home</a></td><td><a href='index.php?page=addcomment&movie=".$movie['Movie_id']."' class='btn btn-primary'>Add Comment</a></td></tr>";
    $sql2= "select * from comment where movieid='".$movie['Movie_id']."'";
    $comments=get_data($sql2);
    while($comment=mysqli_fetch_assoc($comments)){
       
        echo "<tr><td colspan='2'><hr><strong> By ".$comment['username']."<br></strong>".$comment['comment']."<br>---Commnted on ".$comment['date'].".</td></tr>";
    }


}
function add_comment_ui(){
    $sql  = "select  * from moviedetails where Movie_id='".$_GET['movie']."'";
    
    $movies=get_data($sql);
    $movie=mysqli_fetch_assoc($movies);
    echo "<tr><td valign='top' colspan='3'><h3> Add comment for ".$movie['name']."</h3><hr></td></tr><tr>
    <td valign='top' rowspan='2'><img src='../coverimage/".$movie['coverimage']."'></td><td><form action='index.php?movie=".$_GET['movie']."' method='post'><textarea name='comment'></textarea></td></tr><tr><td><input type='submit' class='brn btn-secondary' value='Add Comment'></td>";
}
function add_comment(){
    $sql = "insert  into comment values('".$_SESSION['username']."','".$_GET['movie']."','".$_POST['comment']."',now())";
  if(set_data($sql)){
      echo "<script>window.location='index.php'</script>";
  }
}
function show_my_comments(){
    $sql  = "select  * from comment where username='".$_SESSION['username']."'";

    $comments=get_data($sql);
    echo "<table><tr><th>movie name</th> <th>comment</th> <th>date</th></tr>";
    while($comment=mysqli_fetch_assoc($comments)){
       echo "<tr><td>".$comment['movieid']."</td><td>".$comment['comment']."</td><td>".$comment['date']."</td><td><a href=''>Edit</a>|<a href=''>Details</a>|<a href=''>Delete</a></td></tr></tr>";
   
    }
}
?>
