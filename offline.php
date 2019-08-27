    <?php include 'inc/header.php'; ?>
 
 <?php 
  $login =  Session::get("cuslogin");
  if ($login == false) {
  	header("Location:login.php");
  }

  ?>

 <?php
   if (isset($_GET['orderid']) && $_GET['orderid'] == 'order' ) {
   $cmrId =  Session::get("cmrId");
   $insertOrder = $ct->orderProduct($cmrId);
   $delDate = $ct->delCustomerCart();
  header("Location:success.php");

   }

 ?>



<style>
 .division{width: 50%;float: left;}
.tblone{width: 500px; margin: 0 auto; border: 2px solid #ddd; font-size: 13px;} 
 .tblone tr td{text-align: justify;} 

 .tbltwo{float:right;text-align:left; width: 50%;border: 2px solid #ddd;margin-right: 14px;margin-top: 12px;}
 .tbltwo tr td{text-align: justify; padding: 5px 10px;} 
 .ordernow{}
 .ordernow a{width:150px;margin: 5px auto 0;padding: 7px 0; text-align: center;display: block;background: #555;border: 1px solid #333;color: #fff;border-radius: 3px;font-size: 25px; margin-bottom: 40px;}


</style>

 <div class="main">
    <div class="content">
      <div class="section group">
      
      <div class="division">  

<table class="tblone">
              <tr>
                <td>Sl</td>
                <td>Product</td>
                 
                <td>Price</td>
                <td>Quantity</td>
                <td>Total</td>
                
              </tr>
                                <?php
          $getPro = $ct->getCartProduct();
          if ($getPro) {
            $i = 0;
            $sum = 0;
            $qty = 0;
            while ($result = $getPro->fetch_assoc()) {
               $i++;
                     ?>
                <tr>
                <td><?php echo $i;  ?></td>
                <td><?php echo $result['productName'];  ?></td>
                
                <td>$ <?php echo $result['price'];  ?></td>
                 <td> <?php echo $result['quantity'];  ?></td>
                <td>
                  
                </td>
                <td>$ 
                  <?php 
                  $total = $result['price'] * $result['quantity'];
                  echo $total;

                  ?>      
 
                </td>
               
              </tr>
              <?php 
                  $qty = $qty +  $result['quantity'];
                $sum = $sum + $total;
               

               ?>


              <?php } }   ?>
               
              
            </table>
                         


            <table class="tbltwo">
              <tr>
                <th>Sub Total : </th>
                <td>$ <?php echo $sum;  ?></td>
              </tr>
              <tr>
                <th>VAT : </th>
                <td>   
                   10% (<?php echo $vat = $sum * 0.1; ?> )
                </td>
              </tr>
              <tr>
                <th>Grand Total :</th>
                <td>$<?php 
                  $vat = $sum * 0.1;
                  $gtotal = $sum + $vat;
                  echo $gtotal;
                  ?> </td>
              </tr>


                 <tr>
                <th>Quantity :</th>
                <td> <?php echo $qty; ?></td>
              </tr>
             </table>

      </div>






       <div class="division">  

<?php 
   $id = Session::get('cmrId');
   $getdata = $cmr->getCustomerData($id);
   if ($getdata) {
     while ($result = $getdata->fetch_assoc()) {
        
  ?>


    <table class="tblone">

       <tr>
          
          <td colspan="3"> <h2>  Your Profile Details </h2> </td>
           
      </tr>

      <tr>
          <td width="20%"> Name  </td>
          <td width="5%"> : </td>
          <td> <?php echo $result['name']; ?>  </td>
      </tr>
        <tr>
          <td> Phone  </td>
          <td> : </td>
          <td> <?php echo $result['phone']; ?> </td>
      </tr>

        <tr>
          <td> Email  </td>
          <td> : </td>
          <td> <?php echo $result['email']; ?>  </td>
      </tr>
        <tr>
          <td> Address  </td>
          <td> : </td>
          <td> <?php echo $result['address']; ?>  </td>
      </tr>
        <tr>
          <td> City  </td>
          <td> : </td>
          <td><?php echo $result['city']; ?>  </td>
      </tr>
        <tr>
          <td> Zipcode  </td>
          <td> : </td>
          <td> <?php echo $result['zip']; ?>  </td>
      </tr>
        <tr>
          <td> Country  </td>
          <td> : </td>
          <td> <?php echo $result['country']; ?>  </td>
      </tr>


  <tr>
          <td>   </td>
          <td>  </td>
          <td><a href="editprofile.php"> Update Details </a> </td>
      </tr>

       
    </table>


  <?php   } }  ?> 



       </div>
      

  
    </div>
 </div>
           <div class="ordernow"> <a href="?orderid=order"> Order </a></div>

</div>
   
    <?php include 'inc/footer.php'; ?>