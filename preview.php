  <?php include 'inc/header.php'; ?>

 <?php
  if (isset($_GET['proid'])) {
      
    $id = $_GET['proid'];

  }

 ?>



<?php 
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $quantity = $_POST['quantity'];
        
        $addCart = $ct->addToCart($quantity, $id);
    }   

?>

<?php 
   
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['campare'])) {
        $productId = $_POST['productId'];     
        $insertCom = $pd->inserCompareDate($productId, $cmrId);
    }

?>

<?php 
  
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wlist'])) {
       $saveWlist = $pd->saveWishListData($id, $cmrId);
    }

?>


<style>
.mybutton{width: 100px;float: left;margin-right: 45px;}	

</style>


 <div class="main"> 
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">	

                 <?php 
 				$getPd = $pd->getSingleProduct($id); 
                  if ($getPd) {
                  	while ($result = $getPd->fetch_assoc()) {
                  		 
                  	
					?>



					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $result['image']; ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName'];?> </h2>
					<p><?php echo $fm->textShorten($result['body'], 200);?></p>					
					<div class="price">
						<p>Price: <span>$<?php echo $result['price'];?></span></p>
						<p>Category: <span><?php echo $result['catName'];?></span></p>
						<p>Brand:<span><?php echo $result['brandName'];?></span></p>
					</div>
				<div class="add-cart">
					<form action=" " method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Add to Cart"/>
					</form>				
				</div>
         <span style="color: red; font-size: 18px;">

           <?php 

   if (isset($addCart)) {
   	echo $addCart;
   }
           ?>

</span>
			  <?php 

			   if (isset($insertCom)) {
			   	echo $insertCom;
			   }


			   if (isset($saveWlist)) {
			   	echo $saveWlist;
			   }
			           ?>

			           
					<?php 
					$login =  Session::get("cuslogin");
					if ($login == true) { ?>

				<div class="add-cart">
					<div class="mybutton">  
				 <form action=" " method="post">
						<input type="hidden" class="buyfield" name="productId" value="<?php echo $result['productId']; ?>"/>
						<input type="submit" class="buysubmit" name="campare" value="Add to Campare"/>
					</form>	
					</div>

					<div class="mybutton">  
					<form action=" " method="post">
						 
						<input type="submit" class="buysubmit" name="wlist" value="Wish List"/>
					</form>	
					</div>



				</div>
                     
			<?php  } ?>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<?php echo $result['body'];?>
	    </div>
		<?php } } ?>		
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
 				
 				<?php 
 				 $getCat = $cat->getAllCat();
 				 if ($getCat) {
 				 	while ($result = $getCat->fetch_assoc()) {
 				  	
 				?> 
 				  <li><a href="productbycat.php?catId=<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></a></li>
				      <?php }  }  ?>
				       
    				</ul>
    	
 				</div>
 		</div>
 	</div>
	</div>
    <?php include 'inc/footer.php'; ?>