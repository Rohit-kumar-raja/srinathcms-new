<?php

if (isset($_POST['submit'])) {
    echo "<pre>";
    print_r($_POST);
    // this loop continuous run upto the number of total size of post array
    for ($i = 0; $i < count($_POST['name']); $i++) {
        $event_id = $_POST['event'];
        $name = $_POST['name'][$i];
        $startdoe = $_POST['startd&t'];
        $enddoe = $_POST['endd&t'];
        $no_of_participants = $_POST['limit'][$i];
        $place = $_POST['place'][$i];
        $start_time = $_POST['start'][$i];
        $end_time = $_POST['end'][$i];
        $term_and_conditions = $_POST['t&c'][$i];
        $insert_event = "INSERT INTO `tbl_sub_events`( `name`, `startsubdoe`, `start_time_doe`, `endsubdoe`, `end_time_doe`, `limit`, `place`, `t&c`, `event_id`) VALUES 
                                                ('$name','$startdoe','$start_time','$enddoe','$end_time','$no_of_participants','$place','$term_and_conditions','$event_id')";
        $result_event = mysqli_query($connection, $insert_event);
    }
    if ($result_event > 0) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success</strong> Your Data Successfully Added into the Database
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

// getting all event for showing into the select box

$get_event1 = "SELECT * FROM `tbl_event` WHERE 1";
$event_result1 = mysqli_query($connection, $get_event1);
?>

<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title text-center btn-sm" id="exampleModalLabel">Add Activities</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="container">
                    <div class="row">

                        <div class="col-4">
                            <label>Event </label>
                            <select type="text" placeholder="Enter the Event Name" name="event" class="form-control" required>
                                <option disabled selected> - Select -</option>
                                <?php while ($event_row1 = mysqli_fetch_array($event_result1)) { ?>
                                    <option value="<?php echo $event_row1['id'] ?>"> <?php echo $event_row1['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>



                        <div class="col-4">
                            <label>Start Date </label>
                            <input type="date" placeholder="Event start date and time " name="startd&t" class="form-control">
                        </div>
                        <div class="col-4">
                            <label> End Date </label>
                            <input placeholder="Event end date and time" type="date" name="endd&t" class="form-control">
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-responsive" id="dynamic_field" style="overflow-y:auto;">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Activities Name</th>
                                    <th>LIMIT</th>
                                    <th>Place</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Term & Conditions</th>

                                    <th rowspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="5%"><input type="text" id="slno1" value="1" readonly class="form-control" style="border:none;" /></td>
                                    <td> <input type="text" placeholder="Event Name" name="name[]" class="form-control" required></td>
                                    <td><input type="text" name="limit[]" placeholder="LIMIT" class="form-control" /></td>
                                    <td><input type="text" name="place[]" placeholder="place" class="form-control" /></td>
                                    <td width="5%"><input type="time" name="start[]" placeholder="place" class="form-control" /></td>
                                    <td width="5%"><input type="time" name="end[]" placeholder="place" class="form-control" /></td>
                                    <td width="35%"><textarea name="t&c[]" placeholder="" class="form-control"> </textarea></td>

                                    <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></button></td>

                                </tr>
                            </tbody>
                        </table>
                        <br>
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