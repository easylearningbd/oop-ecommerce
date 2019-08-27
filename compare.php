  <?php include 'inc/header.php'; ?>
 
 <?php 
  $login =  Session::get("cuslogin");
  if ($login == false) {
  	header("Location:login.php");
  }

  ?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Compare </h2>
             
						<table class="tblone">
							<tr>
								<th width="5%">Sl</th>
								<th width="30%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								  
								<th width="10%">Action</th>
							</tr>
                                <?php
                     $cmrId =  Session::get("cmrId");
 					$getPd = $pd->getCompareProduct($cmrId);
 					if ($getPd) {
 						$i = 0;
 						 
 						while ($result = $getPd->fetch_assoc()) {
 							 $i++;
 						         ?>
 								<tr>
								<td><?php echo $i;  ?></td>
								<td><?php echo $result['productName'];  ?></td>
								<td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
								<td>$ <?php echo $result['price'];  ?></td>
								 
								 
						 <td><a href="preview.php?proid=<?php echo $result['productId']; ?>">  View </a> </td>
							</tr>
 							 

							<?php } }   ?>
							 
							
						</table>
								         

					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						 
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
   
    <?php include 'inc/footer.php'; ?>