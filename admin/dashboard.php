<?php include 'include/init.php'; ?>
<?php
     if (!isset($_SESSION['id'])) {
         redirect_to("../");
     }
    $booking_confirm =  Booking::ConfirmedBooking();
    $user_count =  Account_Details::count_user();
    $booking_count =  Booking::count_booking();
    $gallery_count =  Gallery::count_all();
    $gallery = Gallery::find_all();
    $event_post =  EventWedding::count_all();
    $event_wedding = EventWedding::find_all();
?>
<?php $users_profile = Users::find_by_id($_SESSION['id']); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard - Administrator</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
<!--    <link href="css/bootstrap.css" rel="stylesheet">-->
    <link rel="stylesheet" type="text/css"
          href="https://cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <style>
        table.table.table-striped.table-bordered.table-sm {
            font-size:12px;
        }
        .tooltip {
            font-size: 12px;
        }

        td.special {
            padding: 0;
            padding-top: 8px;
            padding-left:6px;
            padding-bottom:6px;
            margin-top:5px;
            text-transform: capitalize;
        }
        .datepicker {
            font-size: 12px;
        }
        .alert-success {
            color: #fff;
            background-color: #49C8AE;
            border-color: none;
        }
        div.dataTables_wrapper div.dataTables_paginate {
            font-size: 11px;
        }

        .card-counter{
    box-shadow: 2px 2px 10px #DADADA;
    margin: 5px;
    padding: 0px 9px;
    background-color: #fff;
    height: 100px;
    border-radius: 5px;
    transition: .3s linear all;
  }

  .card-counter:hover{
    box-shadow: 4px 4px 20px #DADADA;
    transition: .3s linear all;
  }

  .card-counter.primary{
    background-color: #007bff;
    color: #FFF;
  }

  .card-counter.danger{
    background-color: #ef5350;
    color: #FFF;
  }  

  .card-counter.success{
    background-color: #66bb6a;
    color: #FFF;
  }  

  .card-counter.info{
    background-color: #26c6da;
    color: #FFF;
  }  

  .card-counter i{
    font-size: 5em;
    opacity: 0.9;
  }

  .card-counter .count-numbers{
    position: absolute;
    right: 35px;
    top: 20px;
    font-size: 32px;
    display: block;
  }

  .card-counter .count-name{
    position: absolute;
    right: 35px;
    top: 65px;
    text-transform: capitalize;
    opacity: 0.8;
    display: block;
    font-size: 16px;
  }

    </style>
</head>

<body>

<?php include_once 'include/sidebar.php'; ?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h4 class="h4 mt-4">WELCOME, <?= ucfirst($users_profile->firstname) . ' ' . ucfirst($users_profile->lastname); ?></h4>

</div>

    <div class="row">
    <div class="col-lg-3">
      <a href="client.php">
        <div class="card-counter primary">
          <i class="mdi mdi-account-multiple"></i>
          <span class="count-numbers"><?=  $user_count; ?></span>
          <span class="count-name">Total Customers</span>
        </div>
      </a>
    </div>

    <div class="col-lg-3">
      <a href="client.php#targetDiv">
      <div class="card-counter success">
        <i class="mdi mdi-book-open-page-variant"></i>
        <span class="count-numbers"><?=  $booking_count; ?></span>
        <span class="count-name">Total Bookings</span>
      </div>
      </a>
    </div>

    <div class="col-lg-3">
      <a href="photos_view.php">
      <div class="card-counter danger">
        <i class="mdi mdi-image-multiple"></i>
        <span class="count-numbers"><?=  $gallery_count; ?></span>
        <span class="count-name">Photos</span>
      </div>
      </a>
    </div>

    <div class="col-lg-3">
      <a href="blog_events.php">
      <div class="card-counter info">
        <i class="mdi mdi-comment-text"></i>
        <span class="count-numbers"><?=  $event_post; ?></span>
        <span class="count-name">Blogs</span>
      </div>
      </a>
    </div>
  </div>

  <div class="row">
  <div class="col-lg-3">
    <div class="card bg-light mb-3" style="max-width: 18rem;">
        <div class="card-header">TOTAL CUSTOMERS</div>
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Client Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $counter1 = 0;
                    foreach ($booking_confirm as $booking_confirm_row) :
                        if ($counter1 < 5) :
                    ?>
                            <tr>
                                <td><?= (empty($booking_confirm_row->booking_id)) ? 'N/A' : $booking_confirm_row->booking_id; ?></td>
                                <td><?= $booking_confirm_row->firstname . ' ' . $booking_confirm_row->lastname; ?></td>
                            </tr>
                    <?php
                            $counter1++;
                        else :
                            break;
                        endif;
                    endforeach;
                    ?>
                </tbody>
            </table>
            <?php if (count($booking_confirm) > 5) : ?>
                <a href="client.php#targetDiv" class="btn btn-link">Show More</a>
            <?php endif; ?>
        </div>
    </div>
</div>
  
<div class="col-lg-3">
    <div class="card bg-light mb-3" style="max-width: 18rem;">
        <div class="card-header">TOTAL BOOKINGS</div>
        <div class="card-body">
            <!-- Table of Wedding Details -->
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Wedding type</th>
                        <th>Wedding Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $counter = 0;
                    foreach ($booking_confirm as $booking_confirm_row) :
                        if ($counter < 5) :
                    ?>
                            <tr>
                                <td>
                                    <?php
                                    if ($booking_confirm_row->wedding_type == 1) {
                                        echo 'Classic';
                                    } elseif ($booking_confirm_row->wedding_type == 2) {
                                        echo 'Elegant';
                                    } elseif ($booking_confirm_row->wedding_type == 3) {
                                        echo 'Premier';
                                    } elseif ($booking_confirm_row->wedding_type == 4) {
                                        echo 'Gold';
                                    } elseif ($booking_confirm_row->wedding_type == 5) {
                                        echo 'Elite';
                                    } else {
                                        echo 'N/A';
                                    }
                                    ?>
                                </td>
                                <td><?= (empty($booking_confirm_row->wedding_date)) ? 'N/A' : $booking_confirm_row->wedding_date; ?></td>
                            </tr>
                    <?php
                            $counter++;
                        else :
                            break; // Exit the loop after 5 entries
                        endif;
                    endforeach;
                    ?>
                </tbody>
            </table>
            <?php if (count($booking_confirm) > 5) : ?>
                <a href="client.php" class="btn btn-link">Show More</a>
            <?php endif; ?>
        </div>
    </div>
</div>
     
<div class="col-lg-3">
    <div class="card bg-light mb-3" style="max-width: 18rem;">
        <div class="card-header">TOTAL PHOTOS</div>
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Preview</th>
                        <th>Title</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $imageCount = 0;
                    foreach ($gallery as $galleries) :
                        if ($imageCount < 5) :
                    ?>
                            <tr>
                                <td>
                                    <a href="<?= $galleries->picture_path(); ?>" data-lightbox="gallery-group-4">
                                        <img src="<?= $galleries->picture_path(); ?>" alt="Preview" style="max-width: 50px; max-height: 50px;">
                                    </a>
                                </td>
                                <td><?= empty($galleries->title) ? 'No Title' : $galleries->title; ?></td>

                            </tr>
                    <?php
                            $imageCount++;
                        else:
                            break;
                        endif;
                    endforeach;
                    ?>
                </tbody>
            </table>
            <?php if (count($gallery) > 5) : ?>
                <a href="photos_view.php" class="show-more-link">Show More</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="col-lg-3">
    <div class="card bg-light mb-3" style="max-width: 18rem;">
        <div class="card-header">TOTAL BLOGS</div>
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $blogCount = 0;
                    foreach ($event_wedding as $events) :
                        if ($blogCount < 5) :
                    ?>
                            <tr>
                                <td><?= trim_body($events->title, 30); ?></td>
                                <td><?= ($events->status == 0) ? 'Drafted' : 'Published'; ?></td>
                            </tr>
                    <?php
                            $blogCount++;
                        else:
                            break;
                        endif;
                    endforeach;
                    ?>
                </tbody>
            </table>
            <?php if (count($event_wedding) > 5) : ?>
                <a href="blog_events.php" class="show-more-link">Show More</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include_once 'include/footer.php';?>