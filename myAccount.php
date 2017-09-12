<?php
//include "header.php";
include "navHeader.php";

?>

<body>
<div class="container">
    <div class="jumbotron">
        <h2>User Account</h2>
        <p> Sell your product at the best price</p>
    </div>
    <div id = "nav">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#profile">My Profile</a>
                        </li>
                        <li>
                            <a href="#upload">Upload</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    </div>
    <div class="panel-heading">
        <h3>Hello <?php echo $loggedInUser->name."!!"; ?></h3>
    </div>
    <div id = "upload" class="toggle" style="display: none">
    <form name ="userUpload" id = "upload" method="post" action="processUserUpload.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for ="image">Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
            <label for ="title">Product Title</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label for ="price">Description</label>
            <input type="text" name="des" class="form-control">
        </div>
        <div class="form-group">
            <label for ="price">Price</label>
            <input type="text" name="price" class="form-control">
        </div>
        <button type="submit" name="upload" class="btn btn-primary">Upload</button>
    </form>
    </div>

    <div id="profile" class="toggle" style="display:none">
        <div class="col-md-6">
            <form class="form-group" method="post" action="productUpdate.php">
            <table class="table table-bordered">
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <?php $user = myAccountDetails();
                echo "<p><h4>Email</h4>".$loggedInUser->email."</p>";
                echo "<p><h4>Phone</h4>".$loggedInUser->phone."</p>";
                echo "<h3>Your Products</h3>";
                foreach($user as $key => $value)
                    {?>

                <tr> <td>
                        <input  type ="text" name="title[]" size ="30" value="<?php print $value['title']; ?>">
                    </td>

                    <td>
                        <input type ="text" name="des[]" size ="90" value="<?php print $value['description']; ?>">
                    </td>

                    <td>
                        <input type="text" name="price[]" value="<?php print $value['price']; ?>">
                    </td>
                    <input type="hidden" name="id[]" value = "<?php print $value['unique_ID'] ?>">

                </tr>
                    <?php } ?>
            </table>
                <button type="submit" class="btn btn-primary" name="update">Update</button>
            </form>
        </div>
    </div>

</body>
<script>
    $("#nav a").click(function(e){
        e.preventDefault();
        $(".toggle").hide();
        var toShow = $(this).attr('href');
        $(toShow).show();
    });

</script>
</html>