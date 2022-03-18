<?php


if (isset($_GET['id'])) {
  removetocart($_GET['id']);
}


if (isset($_POST['clear'])) {
  unset($_SESSION['pay']);
  unset($_SESSION['hotelasha_cart']);
  message("The cart is empty.", "success");
  redirect(WEB_ROOT . "booking/");
}

check_message();

?>

<div id="accom-title">
  <div class="pagetitle">
    <h1>Your Booking Cart

    </h1>
  </div>
</div>

<table class="table" id="table">

  <thead>
    <tr bgcolor="#999999">
      <!-- <th width="10">#</th> -->
      <th align="center" width="120">Room</th>
      <th align="center" width="120">Check In</th>
      <th align="center" width="120">Check Out</th>
      <th width="120">Price</th>
      <th align="center" width="120">Nights</th>
      <th align="center">Amount</th>
      <th align="center" width="90">Action</th>
    </tr>
  </thead>
  <tbody>
    <div id="showcart"></div>

    <div id="BookingCart">
      <?php
      $mealprice = isset($_SESSION['MealPrice']) ? $_SESSION['MealPrice'] : '0';
      $payable = 0;
      if (isset($_SESSION['hotelasha_cart'])) {


        $count_cart = count($_SESSION['hotelasha_cart']);

        for ($i = 0; $i < $count_cart; $i++) {

          $query = "SELECT * FROM `tblroom` r ,`tblaccomodation` a WHERE r.`ACCOMID`=a.`ACCOMID` AND ROOMID=" . $_SESSION['hotelasha_cart'][$i]['hotelasharoomid'];
          $mydb->setQuery($query);
          $cur = $mydb->loadResultList();
          foreach ($cur as $result) {


            echo '<tr>';
            // echo '<td></td>';
            echo '<td>' . $result->ROOM . ' ' . $result->ROOMDESC . ' </td>';
            echo '<td>' . date_format(date_create($_SESSION['hotelasha_cart'][$i]['hotelashacheckin']), "m/d/Y") . '</td>';
            echo '<td>' . date_format(date_create($_SESSION['hotelasha_cart'][$i]['hotelashacheckout']), "m/d/Y") . '</td>';
            echo '<td > &#8377;' . $result->PRICE . '
                          <input type="hidden" value="' . $result->PRICE . '"  name="roomprice' . $_SESSION['hotelasha_cart'][$i]['hotelasharoomid'] . '" id="roomprice' . $_SESSION['hotelasha_cart'][$i]['hotelasharoomid'] . '"/>

                        </td>';
            echo '<td><input style="border:0px" readonly type="number" value="' . $_SESSION['hotelasha_cart'][$i]['hotelashaday'] . '" id="day' . $_SESSION['hotelasha_cart'][$i]['hotelasharoomid'] . '" name="day' . $_SESSION['hotelasha_cart'][$i]['hotelasharoomid'] . '" /></td>';

            echo  '<input type="hidden"  name="MealPrice' . $_SESSION['hotelasha_cart'][$i]['hotelasharoomid'] . '" id="MealPrice' . $_SESSION['hotelasha_cart'][$i]['hotelasharoomid'] . '"/>';
            echo '</td>';
            echo '<td>$<output id="TotAmount' . $_SESSION['hotelasha_cart'][$i]['hotelasharoomid'] . '" >' . $_SESSION['hotelasha_cart'][$i]['hotelashaprice'] . '</output></td>';
            echo '<td ><a href="index.php?view=processcart&id=' . $result->ROOMID . '">Remove</td>';
          }


          $payable += $_SESSION['hotelasha_cart'][$i]['hotelashaprice'];
        }

        $_SESSION['pay'] = $payable;
      }
      ?>
    </div>
  </tbody>

  <tfoot>
    <tr>
      <td colspan="6">
        <h4 align="right">Total:</h4>
      </td>
      <td colspan="4">
        <h4><b>&#8377;<span id="sum"><?php echo isset($_SESSION['pay']) ?  $_SESSION['pay'] : 'Your booking cart is empty.'; ?></span></b></h4>

      </td>
    </tr>
  </tfoot>
</table>

<form method="post" action="">
  <div class="row">
    <?php
    if (isset($_SESSION['hotelasha_cart'])) {
    ?>
      <button type="submit" class="button " name="clear">Clear Cart</button>
      <?php

      if (isset($_SESSION['GUESTID'])) {
      ?>
        <div class="button "><a href="./index.php?view=payment" name="continue">Continue Booking</a></div>
      <?php
      } else { ?>
        <div class="button "><a href="./index.php?view=logininfo" name="continue">Continue Booking</a></div>
    <?php
      }
    }

    ?>


  </div>

</form>
<?php
unset($_SESSION['MealPrice']);
?>