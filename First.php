<?php 
 include("dbconn.php");
 error_reporting(0);
 if(isset($_POST['sub']))
 {
     $email=$_POST['email'];
     $name=$_POST['name'];
     $age=$_POST['age'];
     $country=$_POST['country'];
     $state=$_POST['state'];
     $city=$_POST['city'];
     if(!empty($email) && !empty($name) && !empty($age) && !empty($country) && !empty($state) && !empty($city))
     {
         if(mysqli_query($conn,"insert into register(email,name,age,country,state,city) values('$email','$name',$age,'$country','$state','$city')"))
         {
            $msg="User registerd successfully";
         }
         else
         $msg="User not registerd successfully";

     }
     else
     $msg="Please fill all the fields";
 }
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <style>
        body {
            background-image: url("https://cdn.dribbble.com/users/34759/screenshots/13971601/media/30298693302288b91b5d3dc292a8cadb.png?compress=1&resize=400x300");
            background-size: cover;
            background-attachment: fixed;

        }
    </style> -->
</head>
<body class="bg-light">
<br><br>
 <?php 
  if(!empty($msg))
  ?><div class="alert alert-success col-5 container" align="center"><i><?php echo $msg;?></i></div>
  <?php
 ?>
<br>
    <div class="border border-dark container mt-4 bg-dark text-light col-6"><br>
        <h2 align="center"><i class="text-info border border-info container col-6">REGISTER HERE</i></h2><br>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="text-warning">Email</label>
                <input type="text" name="email" placeholder="email@gmail.com" class="form-control col-10">
            </div>
            <div class="form-group">
                <label class="text-warning">Name</label>
                <input type="text" name="name" placeholder="enter name" class="form-control col-10">
            </div>
            <div class="form-group">
                <label class="text-warning">Age</label>
                <input type="text" name="age" placeholder="enter age" class="form-control col-10">
            </div>
            <div class="form-group">
            <label class="text-warning">Country</label>
            <select id="country" class="form-control col-10" name="country">
                <option value="">County</option>
                <?php
                 $sel=mysqli_query($conn,"select * from country");
                 while($arr=mysqli_fetch_assoc($sel)){
                 ?>
                 <option value="<?= $arr['id'];?>"><?= $arr['name'];?></option>
                 <?php
                 }
                ?>
            </select>
        </div>
        <div class="form-group">
        <label class="text-warning">State</label>
            <select id="state" class="form-control col-10" name="state" >
                <option value="">State</option>
            </select>
        </div>
        <div class="form-group">
        <label class="text-warning">City</label>
            <select id="city" class="form-control col-10" name="city">
                <option value="">City</option>
            </select>
        </div>
             <br>
            <input type="submit" value="REGISTER" class="btn btn-success col-6" name="sub"><br><br>
    </div>
    </form>
    <br><br>

    <script src="jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function()
        {
            $(document).on('change',"#country",function()
            {
               var countryid=$(this).val();
               if(countryid)
               {
                   $.ajax({
                       type:"post",
                       url:'ajax_part.php',
                       data:{'country_id':countryid},
                       success:function(res)
                       {
                           $('#state').html(res);
                       }
                   })
               }
            });



            $(document).on('change',"#state",function()
            {
               var stateid=$(this).val();
               if(stateid)
               {
                   $.ajax({
                       type:"post",
                       url:'ajax_part.php',
                       data:{'state_id':stateid},
                       success:function(res1)
                       {
                           $('#city').html(res1);
                       }
                   })
               }
            });
        });
    </script>
</body>
</html>