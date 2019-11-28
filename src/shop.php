<!DOCTYPE html>
<html>

<head>
        <meta charset='UTF-8' />
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
        <title>Homepage - Welcome2TheCloud</title>
        <link rel="icon" type="image/png" href="images/Welcome2TheCloud.png" type="image/x-icon">
        <link rel="stylesheet" href="shop.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
                integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
                crossorigin="anonymous">
        <link rel="stylesheet"
                href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
                integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
                crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
                integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                crossorigin="anonymous"></script>
</head>

<body>
        <nav class="navbar sticky-top navbar-expand-lg navbar-light">
                <img alt="Brand" src="images/Welcome2TheCloud.png" style="width: 50px">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                        <ul id="navbar-ul" class="navbar-nav">
                                <li class="nav-item active">
                                        <a class="nav-link" href="#Homepage">Homepage<span class="sr-only"></span></a>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link" href="listprod.php">Products</a>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link" href="listorder.php">Orders</a>
                                </li>
                                <li class="nav-item">
                                        <a id="login-nav" class="nav-link" href="login.html">Login</a>
                                </li>
                        </ul>
                </div>
        </nav>
        <div class="container-fluid">
                <div class="row" id="Homepage">
                        <div class="col-lg-16 col-md-12 col-sm-12" align="center">
                                <div class="slide-content row">
                                                <?php
                                                        include 'include/db_connection.php';
                                                        
                                                        $connection = createConnection();
                                                        $query = $connection->prepare("SELECT * FROM product");
                                                        $query->execute();
                                                        $result = $query->get_result();
                                                        while($row = $result->fetch_assoc()){
                                                                echo '<div class="col-md-3 col-sm-6 col-xs-6 text-center">';
                                                                echo '<a href="product.php?id='.$row["productId"].'">';
                                                                echo '<img src="'.$row["productImageURL"].'" style="width: 100%; height: 80%;">';
                                                                echo '<p>'.$row["productName"].'</p>';
                                                                echo '</a></div>';
                                                        }
                                                ?>
                                </div>
                        </div>
                </div>
        </div>
</body>
<footer class="container mt-12">
		<div class="row">
			<div class="col">
				<p class="text-center">View the code at <a href="https://github.com/Nathan-Nesbitt/Welcome2TheCloud">Welcome2TheCloud</a></p>
			</div>
		</div>
	</footer>

</html>


<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>
<script>

// Function to show the current user if they are logged in and change navbar //

function checkUser() {
        var cookieExists = Cookies.get("loggedIn");
        if(cookieExists){

                // Changes out the login for the Customer Page Navbar Button //
                cookieExists = cookieExists.split(':');
                // Gets the login element //
                var loginElement = document.getElementById("login-nav");
                // Changes the href and the name so it says the logged in users name
                loginElement.href = 'customer.php';
                loginElement.innerHTML = cookieExists[0];

                // Add Admin Navbar Button //
                newLi = '<li class="nav-item"><a class="nav-link" href="admin.php">Admin</a></li>';
                $("#navbar-ul").append(newLi);
                
                // Add the logout navbar button //
                newLi = '<li class="nav-item"><a class="nav-link" href="addProduct.html">Add a Product</a></li>';
                $("#navbar-ul").append(newLi);

                // Add the logout navbar button //
                newLi = '<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>';
                $("#navbar-ul").append(newLi);
        }
}
checkUser();

</script>