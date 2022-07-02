<?php

if (isset($_POST['update']) && ($_POST['id'] == $get_row['id'])) {
    $id = $_POST['id'];
    $event_id = $_POST['event_id'];
    $name = $_POST['name'];
    $startdoe = $_POST['startd&t'];
    $enddoe = $_POST['endd&t'];
    $no_of_participants = $_POST['limit'];
    $place = $_POST['place'];
    $start_time = $_POST['start'];
    $end_time = $_POST['end'];
    $term_and_conditions = $_POST['t&c'];
    $insert_event = "UPDATE `tbl_sub_events` SET `name`='$name',`startsubdoe`='$startdoe',`start_time_doe`='$start_time',`endsubdoe`='$enddoe',`end_time_doe`='$end_time',`limit`='$no_of_participants',`place`='$place',`t&c`='$term_and_conditions',`event_id`='$event_id' WHERE `id`='$id'";
    $result_event = mysqli_query($connection, $insert_event);
    if ($result_event > 0) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success</strong> Your Data Successfully Updated into the Database
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';

        echo "<script>
        setTimeout(function() {
            window.location.replace('../srinath/event_hindi.php')
          }, 1000);

    </script>";
    } else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Alert!</strong> Data Already Exits Please Check Your Input Data
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
}

?>

<!-- Modal -->

<div class="modal fade" id="exampleModal1<?php echo $get_row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title text-center btn-sm" id="exampleModalLabel">Add Event</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="container">
                    <div class="row">
                        <?php
                        $getting_event = "SELECT * FROM `tbl_event` WHERE 1 ";
                        $getting_event_result = mysqli_query($connection, $getting_event);


                        ?>
                        <input type="hidden" name="id" value="<?php echo $get_row['id']; ?>">
                        <div class="col-4">
                            <label>Event Name</label>
                            <select type="text" name="event_id" class="form-control" required>
                                <?php
                                while ($getting_event_row = mysqli_fetch_array($getting_event_result)) { ?>
                                    <option value="<?php echo $getting_event_row['id'] ?>"><?php echo $getting_event_row['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>


                        <div class="col-4">
                            <label>Activities Name</label>
                            <input type="text" value="<?php echo $get_row['name']; ?>" placeholder="Enter the Event Name" name="name" class="form-control" required>
                        </div>

                        <div class="col-4">
                            <label>Start Date</label>
                            <input type="date" value="<?php echo $get_row['startsubdoe']; ?>" placeholder="Event start date and time " name="startd&t" class="form-control">
                        </div>
                        <div class="col-4">
                            <label>Start Time</label>
                            <input type="time" value="<?php echo $get_row['start_time_doe']; ?>" placeholder="Event start date and time " name="start" class="form-control">
                        </div>
                        <div class="col-4">
                            <label> End Date</label>
                            <input type="date" value="<?php echo $get_row['endsubdoe']; ?>" name="endd&t" class="form-control">
                        </div>
                        <div class="col-4">
                            <label> End Time</label>
                            <input type="time" value="<?php echo $get_row['end_time_doe']; ?>" name="end" class="form-control">
                        </div>
                        <div class="col-4">
                            <label>Limit</label>
                            <input type="text" name="limit" value="<?php echo $get_row['limit']; ?>" placeholder="Total number of Participants from one organizations" class="form-control" title="Total number of Participants from one organizations ">

                        </div>
                        <div class="col-4">
                            <label>Place</label>
                            <input type="text" placeholder="Enter the place of the Events" value="<?php echo $get_row['place']; ?>" name="place" class="form-control">
                        </div>
                        <div class="col-4">
                            <label>T&C</label>
                            <textarea name="t&c" rows="5" class="form-control" title="Enter and terms and condition of the Events"><?php echo $get_row['t&c']; ?></textarea>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>