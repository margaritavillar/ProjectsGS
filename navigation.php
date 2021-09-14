        <div class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="products.php">Khatereh Eccomerce</a>
                </div>

                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">

                        <!-- highlight if $page_title has 'Products' word. -->
                        <li <?php echo strpos($page_title, "Product")!==false ? "class='active'" : ""; ?>>
                            <a href="products.php">Products</a>
                        </li>

                        <li <?php echo $page_title=="Cart" ? "class='active'" : ""; ?> >
                            <a href="cart.php">
                              <?php
                               
                                      //count the products in the Cart
                                      $cart_item = new CartItem($db);
                                      $cart_item->user_id=$_SESSION['userId']; //default to user iwth ID "1" for now
                                      $cart_count = $cart_item->count();
                                  ?>
                                  Cart <span class="badge" id="comparison-count"><?php echo $cart_count ?></span>
                            </a>
                        </li>
                        <li> 
                            <?php
                                $logout = $_SESSION['userId'] > 0;
                                $msg = $_SESSION['userId'] > 0 ? ("Welcome Dear: " . $_SESSION['email']) : "login";
                                $path = $_SESSION['userId'] > 0 ? "#" : "login.php";
                            ?>
                            <a href="<?= $path ?>"><?php echo $msg ?></a>

                            <?php if ($logout) {
                                 echo '<a href="logout.php">logout</a>';
                            } 
                            ?>
                        </li>
                    </ul>

                </div><!--/.nav-collapse -->

            </div>
        </div>
        <!-- /navbar -->
