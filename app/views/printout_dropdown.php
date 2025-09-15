<?php 
	include_once('header.php');
	include_once('navbar.php');
?>


<div class="container-fluid mt-3">
    <h1>Printout Dropdown List</h1>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Customer Name</label>
            <select class="form-select" name="cust_id" required>
                <option value="" disabled selected>Select a customer</option>
				<?php
                    foreach ($customers as $customer) {
                        echo '<option value="' . htmlspecialchars($customer->cust_id) . '">' . htmlspecialchars($customer->cust_name) . '</option>';
                    }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" class="form-control" name="date" value="<?php echo date('Y-m-d'); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary" name="printout">Generate Printout</button>
    </form>
</div>


<?php
	include_once('footer.php');
?>