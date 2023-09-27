<?php
/****************************************************
****   IHN Bible College
****   Designed by: Tom Moore
****   Written by: Tom Moore
****   (c) 2001 - 2021 TEEMOR eBusiness Solutions
****************************************************/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>IHN Bible College Library</title>
    <meta name="author" content="TEEMOR eBusiness Solutions" />
    <!--meta name="keywords" content="< ?php echo TM_KEYWORDS; ?>" />
    <meta name="description" content="< ?php echo TM_DESCRIPTION; ?>" /-->
    <link rel="shortcut icon" href="images/myfav.png" />
    <!-- **********************  BOOTSTRAP  **********************************************************************-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- **********************  Font Awesome  ****************************************************************** -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- **********************  END BOOTSTRAP  ******************************************************************-->

    <link rel="stylesheet" type="text/css" href="css/styles.css" />
        
	<style>
	body {
		background-color:#FFF;
		height: 100vh;
	}
	</style>
</head>
<body>
    <section>
        <div class='container-fluid'>
            <div class='row clearfix'>
                <div class='col-sm-12 text-center'>
                    <img src="/library/img/ihnbible_logo_900x150.png" width="100%">
                    <br>
                    <font size="+3"><strong>Hermeneutics & Homiletics</strong></font>
                    <br><br>
					<?php
					// open this directory 
					$myDirectory = opendir(".");

					// get each entry
					while($entryName = readdir($myDirectory)) {
						$dirArray[] = $entryName;
					}

					// close directory
					closedir($myDirectory);

					//	count elements in array
					$indexCount	= count($dirArray)-3;

					// sort 'em
					sort($dirArray);

					// loop through the array of files and print them all
					for($index=0; $index < $indexCount+2; $index++) {
						if($dirArray[$index] != 'index.php') {
							if (substr("$dirArray[$index]", 0, 1) != "."){ // don't list hidden files
								print("<a href=\"$dirArray[$index]\" target=\"_blank\">$dirArray[$index]</a>");
								print("<br>");
							}
						}
					}
					echo "<br><br>";
					?>
                    <a href="/library/index.php"><button type="button" class="btn btn-primary btn-lg btn-block" data-dismiss="modal"><-- BACK</button></a>

                </div>
            </div>
        </div>
    </section>
</body>
</html>