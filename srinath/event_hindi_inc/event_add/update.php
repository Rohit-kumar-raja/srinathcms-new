<?php

if (isset($_POST['update']) && ($_POST['id']==$get_row['id'])) {
    $ev_id=$_POST['id'];
    $name = $_POST['name'];
    $startdoe = $_POST['startd&t'];
    $enddoe = $_POST['endd&t'];
    $no_of_participants = $_POST['no_of_participants'];
    $place = $_POST['place'];
    $term_and_conditions = $_POST['t&c'];
        $insert_event = "UPDATE `tbl_event` SET `name`='$name',`startdoe`='$startdoe',`endoe`='$enddoe',`t&c`='$term_and_conditions',`no_of_participants`='$no_of_participants',`place`='$place',`status`='1' WHERE `id`='$ev_id'";
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
            window.location.replace('../srinath/event_add')
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

                    <input type="hidden" name="id" value="<?php echo $get_row['id']; ?>">
                        <div class="col-6">
                            <label>Event Name</label>
                            <input type="text" value="<?php echo $get_row['name']; ?>" placeholder="Enter the Event Name" name="name" class="form-control" required>
                        </div>

                        <div class="col-6">
                            <label>Start Date & time</label>
                            <input type="datetime-local" value="<?php echo $get_row['startdoe']; ?>" placeholder="Event start date and time " name="startd&t" class="form-control">
                        </div>
                        <div class="col-6">
                            <label> End Date & time</label>
                            <input type="datetime-local" placeholder="Event end date and time" value="<?php echo $get_row['endoe']; ?>"  name="endd&t" class="form-control">
                        </div>
                        <div class="col-6">
                            <label>Limit</label>
                            <input type="text" name="no_of_participants"value="<?php echo $get_row['no_of_participants']; ?>" placeholder="Total number of Participants from one organizations" class="form-control" title="Total number of Participants from one organizations ">

                        </div>
                        <div class="col-6">
                            <label>Place</label>
                            <input type="text" placeholder="Enter the place of the Events" value="<?php echo $get_row['place']; ?>" name="place" class="form-control">
                        </div>
                        <div class="col-6">
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