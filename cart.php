<?php
require("inc/function.php");
if(isset($_POST["ok"]))

	{
	 //echo($_POST["id"]);
	 //session_destroy();
     createcart();
     $query= "SELECT * FROM produit WHERE id_produit=".$_POST["id"];
     $result=execute_query($query);
     $product = $result->fetch_assoc();


     addItem($_POST["id"],$_POST["qty"],$product["prix"],$product["titre"]);


    printt();




	}
     else

{
     createcart();
      printt();

    //DeleteITem("6"); 

}