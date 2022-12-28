<?php 
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<style>
  body {
    width: 100%;
    background-color: #f9fbfb;
    position: relative;
    
}
div.main-container{
    left: 0;
    top: 0;
    display: flex;
    flex-direction: row;    
    align-items: flex-start;
    justify-content: space-around;
    flex-flow: wrap;
    margin-top: 90px
}

div.iteam-containers {
    height: auto;
    width: 100%;
    background: #fff;
    margin-top: 100px;
    margin-left: 10%;
    border: 5px solid #fff;
    border-radius: 5px;
    display: flex;
    flex-direction: row;
    overflow: auto;
    justify-content: space-between;
    align-items: center;
}

div.iteam-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    height: auto;
    width: auto;
    background: #fefefe;
    border: 2px solid #e5e7eb;
    border-radius: 5px;
    margin: 10px;
    cursor: pointer;
    transition: 0.5s;
}
div.iteam-box img {
    height: 250px;
    width: 300px;
    margin: 12px 20px 0 20px;
}
div.iteam-box:hover{
    transform: scale(1.1);
}

div.iteam-box img:hover{
    transition: transform 0.5s;
}
div.iteam-value{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
}

div.iteam-value h2{
    color: red;
    font-size: 25px;
    margin-bottom: 5px;

}

div.iteam-value span{
    color: black;
    font-weight: bold;
    margin-bottom: 5px;
    
}

@media only screen and (max-width: 376px) {
    div.iteam-box img {
    height: 100px;
    width: 115px;
    margin: 4px;
}
div.main-container{
      
      /* justify-content: space-between; */
      margin: 110px 20px 0px 20px;
  }
}

@media only screen and (max-width: 450px) {
  
    div.main-container{
      
        /* justify-content: space-between; */
        margin: 110px 5px 0px 5px;
    }

    div.iteam-box img {
    height: 110px;
    width: 125px;
    margin: 4px;
}
div.iteam-value h2{
    
    font-size: 10px;
    
}

div.iteam-value span {
	font-size: 9px;
    font-weight: bold;
}

div.iteam-box {
    margin: 5px 0px 5px 0px;
}
  
}
</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link rel="stylesheet" href="main.css">
</head>

<?php 
    include 'Funtions.php';
    include 'header.php'; 
    include 'login_register_popup.php';
    ?>
<body onload="getLogLet();">
<!-- 
<form action="index.php" class="form" method="POST">
    <input type="text" name="lat" id="lat" placeholder="enter">
    <input type="text" name="log">
    <button type="submit"  id="location">submit</button>
    </form> -->
    <div class="main-container">
   

    <?php
    function calculateDistance($lat1,$log1,$lat2,$log2){
        $theta=$log1-$log2;
        $miles=(sin(deg2rad($lat1)))*sin(deg2rad($lat2))+(cos(deg2rad($lat1))*cos(deg2rad($lat2))*cos(deg2rad($theta)));
        $miles=acos($miles);
        $miles=rad2deg($miles);
        $result['miles']=$miles*60*1.1515;
        $result['feet']=$result['miles']*5280;
        $result['yards']=$result['feet']/3;
        $result['kilometers']=$result['miles']*1.609344;
        $result['meters']=$result['kilometers']*1000;
        return $result;
    }
   
    
    // echo json_encode(calculateDistance($lat1,$log1,$lat2,$log2));
     $lat1 = $_COOKIE['lat'];
     $log1 = $_COOKIE['log'];
    //  echo $lat1.$log1."check data";
     
        include 'connection.php';
        $query = "SELECT * FROM product";
        $re = mysqli_query($con, $query);
        $check_iteams=mysqli_num_rows($re)>0;
        if($check_iteams){
            while($row = mysqli_fetch_array($re)){
                $query_user = "SELECT * FROM user_table where user_id=$row[user_id]";
                $rs = mysqli_query($con, $query_user);             
                $check_user=mysqli_num_rows($rs)>0;
                if($check_user){
                    $row_user = mysqli_fetch_array($rs);
                    $lat2=$row_user['lat'];
                    $log2=$row_user['log'];
                    $result=calculateDistance($lat1,$log1,$lat2,$log2);
                    // echo "<script>alert('$result[kilometers] $row_user[lat] $row_user[log]')</script>";
                    // echo round($result['kilometers'],3);
                    if($result['kilometers']<5){
                        ?>
                    
                        <a href='product_def.php?product_id=<?php echo base64_encode($row['product_id']); ?>& km=<?php echo base64_encode($result['kilometers']); ?>'><div class='iteam-box' >
                        <img src=' uploads/<?php echo $row['image']; ?>' alt='product'>
                        <div class='iteam-value'>
                            <h2><?php echo $row['product_name']; ?></h2>
                            <span><?php echo "₹".$row['price'] . " Per/".$row['unit'];?></span>
                        </div>
                    </div>
                           </a>
                           </form>
                       <?php
                    }
                 
                    // echo $row['user_id'].$row['product_name'].$row_user['name'];
                  
                    
                }else{
                    echo "<script>alert('not found')</script>"; 
                }
            }

                
            

        }else{
            echo "
            <script>alert('Data not found......')</script>
            ";
        }
    ?>
    </div>
    <?php
    if (isset($_SESSION['logedin'])) {
        echo "<h1 style='text-align: center; margin-top:200px'>WELCOME TO THIS WEBSITE - $_SESSION[name]  $_SESSION[user_id]</h1> ";
        
    }
    ?>   
</body>

</html>