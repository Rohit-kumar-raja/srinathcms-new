<?php
include '../../Backend/connection.inc.php';
$id = $_GET['event'];

$event_qury = "SELECT * FROM `tbl_event` WHERE 1";
$result = mysqli_query($connection, $event_qury);
$date = mysqli_fetch_array($result);
// getting the all activities of the event
$event_qury1 = "SELECT * FROM `tbl_sub_events` WHERE 1";
$result1 = mysqli_query($connection, $event_qury1);

?>

<div class="col-sm-5  mt-3">
    <label>
        प्रारंभ दिनांक और समय: <br>
        Start Date & Time :</label>
    <input disabled id="form_no" value="<?php echo $date['startdoe'] ?>" type="text" name="university"
        class="form-control" placeholder="विश्वविद्यालय का नाम " required>
</div>
<div class="col-sm-5  mt-3">
    <label>समाप्ति दिनांक और समय:
        <br>
        End Date & Time :</label>
    <input type="text" disabled value="<?php echo $date['endoe'] ?>" name="department" class="form-control" value=""
        placeholder="विभाग">
</div>

<div class="col-4  mt-3">
    <label>गतिविधियों का नाम : <br>
        Activities Name :</label>
    <br>

</div>
<div class="col-2  mt-3">
    <label>प्रारंभ समय
        : <br>
        Started time :</label>
    <br>

</div>
<div class="col-2  mt-3">
    <label>समाप्त समय

        : <br>
        Ended time :</label>
    <br>

</div>
<div class="col-2  mt-3">
    <label>
        नियम व शर्तें

        : <br>
        Term and Conditions :</label>


</div>

<?php while ($row1 = mysqli_fetch_array($result1)) { ?>

<section>



    <!-- The Modal -->
    <div class="modal" id="myModal<?php echo $row1['id']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $row1['name']; ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <?php echo $row1['t&c']; ?> </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>


</section>
<div class="col-4  mt-3">
    <label class="la" for="">
        <input type="checkbox" name="event_name[]" value="<?php echo $row1['name']; ?>"> <?php echo $row1['name']; ?>
        :</label>
</div>

<div class="col-2  mt-3">
    <input type="hidden" name="start[]" value="<?php echo $row1['start_time_doe']; ?>">
    <label class="la" for=""><?php echo $row1['start_time_doe']; ?></label>
</div>

<div class="col-2  mt-3">
    <input type="hidden" name="end[]" value="<?php echo $row1['end_time_doe']; ?>">
    <label class="la" for=""><?php echo $row1['end_time_doe']; ?></label>
</div>
<div class="col-2  mt-3">
    <!-- Button to Open the Modal -->
    <a type="button" class="text-danger" data-toggle="modal" data-target="#myModal<?php echo $row1['id']; ?>">
        T&C
    </a>

</div>
<div class="col-12  mt-3">
    <!-- Button to Open the Modal -->
    <table class="table table-bordered table-responsive" id="dynamic_field<?php echo $row1['id']?>"
        style="overflow-y:auto;">
        <thead>

        </thead>
        <tbody>
            <tr>

                <td><button type="button" name="add" id="add<?php echo $row1['id'] ?>" class="btn btn-success"><i
                            class="fa fa-plus" aria-hidden="true"> Add</i></button></td>
            </tr>
        </tbody>
    </table>
</div>
<?php } ?>
