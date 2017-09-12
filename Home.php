<?php
//require_once("config.php");
include "header.php";
include "navHeader.php";
include "API_Call.php";

?>

<body>
<div class="container">
    <div class="jumbotron">

        <div class="page-header">
            <h2> Search For The Item</h2>
        </div>
        <div class="center-block">
            <form class="form-group" action="<?php $_SERVER['PHP_SELF'] ?>">
                <input class="form-control" id="box" type="text" name="search" placeholder="Search your item here">
                <br>
                <button class="btn btn-primary" name="submit" type="submit" name="submit">SEARCH</button>
                <br>
            </form>
        </div>
    </div>
</div>

<div class="table-responsive col-md-4">
    <table class="table table-bordered">
        <h1>
            <small class="text-muted">Walmart Pricing For The Item</small>
        </h1>
        <th class="active">Image</th>
        <th class="active">Item Name</th>
        <th class="active">Item Price($)</th>
        <th class="active"></th>

        <?php
        usort($arrayObjWal, "sortWalArrayBySalePrice");
        function sortWalArrayBySalePrice($obj1, $obj2)
        {
            return $obj1['salePrice'] - $obj2['salePrice'];
        }

        ?>
        <?php foreach (limit($arrayObjWal, 5) as $key => $value) {
            $prodDescription = $value['productUrl'] ?>

            <tr>
                <td><?php echo "<div class = 'thumbnail'>";
                    echo "<img src = " . $value['thumbnailImage'] . ">";
                    echo "</div>"; ?></td>
                <td><?php echo $value['name'] . "<br>"; echo "<img src = " . $value['customerRatingImage'] . ">"; ?></td>
                <td><?php echo $value['salePrice'] . "<br>"; ?></td>
                <td>
                    <button class=" btn btn-primary" type="submit" name="view" onclick="javacript :window.open('<?php echo $value['productUrl']; ?>');" >View</button>
                </td>
            </tr>

        <?php } ?>
    </table>
</div>

<div class="table-responsive col-md-4">
    <table class="table table-bordered">
        <h1>
            <small class="text-muted">eBay Pricing For The Item</small>
        </h1>
        <th class="active">Image</th>
        <th class="active">Item Name</th>
        <th class="active">Item Price($)</th>
        <th class="active"></th>

        <?php
        usort($arrayObjEbay, "sortEbayArrayBySalePrice");
        function sortEbayArrayBySalePrice($value1, $value2)
        {
            return $value1['sellingStatus'][0]['currentPrice'][0]['__value__'] >
                $value2['sellingStatus'][0]['currentPrice'][0]['__value__'];
        }

        ?>
        <?php foreach (limit($arrayObjEbay, 5) as $key => $value) { ?>

            <tr>
                <td><?php echo "<div class = 'thumbnail'>";
                    echo "<img src = " . $value['galleryURL'][0] . " >";
                    echo "</div>"; ?></td>
                <td><?php echo $value['title'][0] . "<br>"; ?></td>
                <td><?php echo $value['sellingStatus'][0]['currentPrice'][0]['__value__'] . "<br>"; ?></td>
                <td>
                    <button class="btn btn-primary" type="submit" name="viewebay" onclick="javascript :window.open('<?php echo $value['viewItemURL'][0]; ?>');">View</button>
                </td>
            </tr>

        <?php } ?>
    </table>
</div>

    <div class="table-responsive col-md-4">
        <table class="table table-bordered">
            <h1>
                <small class="text-muted">Seller Pricing</small>
            </h1>
            <th class="active">Image</th>
            <th class="active">Item Name</th>
            <th class="active">Item Price($)</th>
            <th class="active"></th>

       <?php foreach($foundItem as $key => $value){ ?>
            <tr>
                    <form method="post" >
                        <td><?php echo "<div class='thumbnail'>";
                            echo "<img src=".'./FileUploads/'.$value['new_file_name']." width=\"70\" height=\"70\">"; echo "</div>";?>
                        </td>
                        <td><?php print $value['title']; ?></td>
                        <td><?php print $value['price']; ?></td>
                        <td><label>Quantity</label><input type="text" size="2" maxlength="2" name="qty" value="1" />
                        <input type="hidden" name="pid" value="<?php print $value['unique_ID']; ?>" >
<!--                        <a role="submit" name="buy" class="btn btn-primary" href ="cart.php?id=--><?php //print $value['unique_ID']; ?><!--">Add To Cart</a> </td>-->
                            <button type="submit" name="buy" class="btn btn-primary">Add To Cart</button> </td>
                    </form>
            </tr>
        <?php }?>
    </table>
</div>

<?php
//var_dump($_SESSION);
if(!empty($_POST)) {
    $errors = array();

    if (isset($_POST["qty"]) && isset($_POST["pid"]) && $_POST["qty"] > 0 && isset($_POST['buy'])) {
        $pcode=$_POST['pid'];
        $pqty = $_POST['qty'];
        // function add / append an item to the cart
        addtocart($pcode,$pqty);
    }
} else {
    $errors[] = "quantity = 0 / something went wrong";
}
?>
<footer class="footer navbar-fixed-bottom">
    <div class="container">
        <p>Copyright &copy; Anukrati Khare Website 2017</p>
    </div>
</footer>
</body>
</html>
