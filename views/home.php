<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <title>Home</title>
</head>
<body>
    
   

<div class="container">
Hi! <?php echo $_SESSION['username']?>
    <span style='float:right'>
    <button class='btn btn-primary' onclick='signout()'>Signout</button>
    <button class='btn btn-secondary' onclick='goto()'>My comments</button>
</span>
<table cellpadding='20px' cellspacing='10px'>
       <tr>
           <td  colspan='2' class='alert alert-success' valign='top'>
               <a href="index.php">All Movies</a><br>
               <a href="index.php?page=search">Search Movies</a><br>
               <hr>
               <a href="index.php?genere=action">Action Movies</a><br>
               <a href="index.php?genere=adventure">Adventure Movies</a><br>
               <a href="index.php?genere=biography">Biography Movies</a><br>
               <a href="index.php?genere=crime">Crime Movies</a><br>
               <a href="index.php?genere=comedy">Comedy Movies</a><br>
               <a href="index.php?genere=drama">Drama Movies</a><br>
               <a href="index.php?genere=fantasy">Fantasy Movies</a><br>
               <a href="index.php?genere=history">History Movies</a><br>
               <a href="index.php?genere=sci-fi">Sci-Fi Movies</a><br>
               <a href="index.php?genere=thriller">Thriller Movies</a><br>

        
        </td>
    
    <td>

    <table style = "font-size:80%">
        <?php
        if(isset($_GET['genere']) == false) {
            if(isset($_GET['page']) && $_GET['page'] == 'search') {
                echo "<tr><td valign='top' colspan='3'><h1>Search Movies</h1><hr></td></tr><form action='' method='post'><tr><td>Enter Movie Name</td><td><input type='text' name='moviename'></td><td><input type='submit' class='btn btn-secondary' value='Search'></td></tr></form>";
               if(isset($_POST['moviename'])) {
                    search_movie();
               }
            } else if(isset($_GET['movieid'])) {
                show_movie();
            } else if(isset($_GET['page']) && $_GET['page'] =='addcomment') {
                add_comment_ui();
            } else if(isset($_POST['comment'])) {
                add_comment();
            } else if(isset($_GET['page']) && $_GET['page'] == 'mycomments') {
                
                show_my_comments();
            } else {
                all_movies();
            }
            
        } else {
            movies_by_genere();
        }
        ?>
       
    </table>
    </td>
    </tr>
   </table>
</div>
   

<script>
function signout() {
    location.href = 'index.php?page=signout';
}
function goto() {
    location.href = 'index.php?page=mycomments';
}
</script>
</body>
</html>
