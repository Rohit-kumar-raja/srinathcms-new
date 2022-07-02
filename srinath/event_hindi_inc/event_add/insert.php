<?php

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $startdoe = $_POST['startd&t'];
    $enddoe = $_POST['endd&t'];
    $no_of_participants = $_POST['no_of_participants'];
    $place = $_POST['place'];
    $term_and_conditions = $_POST['t&c'];
    $insert_event = "INSERT INTO `tbl_event`(`name`, `startdoe`, `endoe`, `t&c`, `no_of_participants`, `place`, `status`) VALUES 
                                                    ('$name','$startdoe','$enddoe','$term_and_conditions','$no_of_participants','$place','1')";
    $result_event = mysqli_query($connection, $insert_event);
    if ($result_event > 0) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success</strong> Your Data Successfully Added into the Database
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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


                        <div class="col-6">
                            <label>Event Name</label>
                            <input type="text" placeholder="Enter the Event Name" name="name" class="form-control" required>
                        </div>

                        <div class="col-6">
                            <label>Start Date & time</label>
                            <input type="datetime-local" placeholder="Event start date and time " name="startd&t" class="form-control">
                        </div>
                        <div class="col-6">
                            <label> End Date & time</label>
                            <input placeholder="Event end date and time" type="datetime-local" name="endd&t" class="form-control">
                        </div>
                        <div class="col-6">
                            <label>Limit</label>
                            <input type="text" name="no_of_participants" placeholder="Total number of Participants from one organizations" class="form-control" title="Total number of Participants from one organizations ">

                        </div>
                        <div class="col-6">
                            <label>Place</label>
                            <input type="text" placeholder="Enter the place of the Events" name="place" class="form-control">
                        </div>
                        <div class="col-6">
                            <label>T&C</label>
                            <textarea name="t&c" rows="5" class="form-control" title="Enter and terms and condition of the Events"></textarea>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>