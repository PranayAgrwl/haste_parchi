<?php 
include_once('header.php');
include_once('navbar.php');
?>

<div class="container-fluid mt-3">
    <div class="row justify-content-between align-items-center mb-4">
        <div class="col-md-8">
            <h1 class="display-5 fw-bold">Customer Names List</h1>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <button type="button" class="btn btn-outline-primary btn-lg" data-bs-toggle="modal" data-bs-target="#myModal">
                Add Customer
            </button>
        </div>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Customer ID</th>
                <th>Station</th>
                <th>Transport</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i=1;
                foreach($viewdata as $key)
                {
            ?>
                <tr>
                    <td><?php echo $key -> cust_id; ?></td>
                    <td><?php echo $key -> cust_name; ?></td>
                    <td><?php echo $key -> cust_station; ?></td>
                    <td><?php echo $key -> cust_transport; ?></td>
                    <td>
                        <button
                            type="button"
                            class="btn btn-outline-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#editModal"
                            data-id="<?php echo $key->cust_id; ?>"
                            data-name="<?php echo $key->cust_name; ?>"
                            data-station="<?php echo $key->cust_station; ?>"
                            data-transport="<?php echo $key->cust_transport; ?>"
                        >
                            Edit
                        </button>
                    </td>
                    <td>
                        <form method="post" onsubmit="return confirm('ARE YOU SURE YOU WANT TO DELETE THIS CUSTOMER!');">
                            <input type="hidden" name="cust_id" value="<?php echo $key->cust_id; ?>">
                            <button type="submit" class="btn btn-outline-danger" name="del_cust">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            <?php
                $i++;
                }
            ?>
        </tbody>
  </table>





</div>



<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Customer</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST">
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
                        <label>Name</label>
                    </div>
                    <div class="form-floating mt-3 mb-3">
                        <input type="text" class="form-control" id="station" placeholder="Enter Station" name="station">
                        <label>Station</label>
                    </div>
                    <div class="form-floating mt-3 mb-3">
                        <input type="text" class="form-control" id="transport" placeholder="Enter Transport" name="transport">
                        <label>Transport</label>
                    </div>
                    <button type="submit" class="btn btn-primary" name="add_cust">Submit</button>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Customer</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST">
                    <input type="hidden" name="cust_id" id="edit_id">
                    <div class="mb-3 mt-3">
                        <label>Name:</label>
                        <input type="text" class="form-control" name="name" id="edit_name">
                    </div>
                    <div class="mb-3">
                        <label>Station:</label>
                        <input type="text" class="form-control" name="station" id="edit_station">
                    </div>
                    <div class="mb-3">
                        <label>Transport:</label>
                        <input type="text" class="form-control" name="transport" id="edit_transport">
                    </div>
                    <button type="submit" class="btn btn-primary" name="edit_cust">Submit</button>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<script>
    var editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;

        var id = button.getAttribute('data-id');
        var name = button.getAttribute('data-name');
        var station = button.getAttribute('data-station');
        var transport = button.getAttribute('data-transport');

        document.getElementById('edit_id').value = id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_station').value = station;
        document.getElementById('edit_transport').value = transport;
    });
</script>

<?php
include_once('footer.php');
?>
