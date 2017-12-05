<?php
	session_start();

	if (!isset($_SESSION['accessToken'])) {
		header ('Location: login.php');
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	<title>User Profile</title>
    <style>
        table {
            margin: 50px;
            float: left;
            border: 2px solid black;
            width: 400px;
            height: 500px
        }
        tr, td {
            border: 2px solid black;
        }

    </style>

</head>
<body>
    <div>
        <b><?php echo $_SESSION['userData']['name']?></b>
    </div>
    <?php
    foreach ($_SESSION['userData']['posts'] as $post) {

        ?>
        <div>
            <table>
                <tr>
                    <td colspan="3">
                        <b>DATE: </b><?php echo $post['created_time'];?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><img src="
                        <?php echo $post['picture']; ?>
                    "></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>DESCRIPTION: </b><?php echo $post['description'];?>
                    </td>
                </tr>
                <tr>
                    <td><b>LIKES: </b><?php echo $post['likes']?></td>
                    <td><b>SHARES: </b><?php echo $post['shares']?></td>
                    <td><a href="<?php echo $post['permalink_url']?>"><b>See post on Facebook</b></a></td>
                </tr>
            </table>
        </div>
        <?php
    }
    ?>

</body>
</html>


