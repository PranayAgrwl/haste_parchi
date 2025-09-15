<?php

require_once ("app/models/Model.php");

class Controller
{
	private $model;
	public function __construct()
	{
		$this->model = new Model();
	}
	public function index()
	{
		include ('app/views/index.php');
	}
	public function home()
	{
		include ('app/views/home.php');
	}
	public function error404()
	{
		include ('app/views/error404.php');
	}
	public function master()
	{
		$viewdata = $this -> model -> selectData ("master");
		usort($viewdata, function($a, $b) 
		{
			return strcasecmp($a->cust_name, $b->cust_name); // A-Z
		});

		if(isset($_REQUEST['edit_cust']))
		{
			$custid = $_REQUEST['cust_id'];
			$name = $_REQUEST['name'];
			$station = $_REQUEST['station'];
			$transport = $_REQUEST['transport'];
			
			$edit_data=["cust_name"=>$name, "cust_station"=>$station, "cust_transport"=>$transport];
			$result = $this -> model -> updateData ("master", $edit_data, ['cust_id'=>$custid]);
			if(isset($result))
			{
				// echo "Update Success";
				header("Location: master");
				exit();
			}
			else
			{
				echo "Error Updating Database";
			}
		}

		if(isset($_REQUEST['add_cust']))
		{
			$name=$_REQUEST['name'];
			$station=$_REQUEST['station'];
			$transport=$_REQUEST['transport'];

			$data=["cust_name"=>$name, "cust_station"=>$station, "cust_transport"=>$transport];
			$result = $this -> model -> insertData ("master", $data);
			if(isset($result))
			{
				// echo "Data Inserted";
				header("Location: master");
				exit();
			}
			else
			{
				echo "Error Inserting Data";
			}
		}

		if(isset($_REQUEST['del_cust']))
		{
			$custid = $_REQUEST['cust_id'];
			// echo $custid;
			// exit();
			$result = $this -> model -> deleteData ("master", ['cust_id' => $custid]);
			if(isset($result))
			{
				// echo "Data Deleted Successfuly";
				header("Location: master");
				exit();
			}
			else
			{
				echo "Error Deleting Data";
			}
		}

		include ('app/views/master.php');

	}

	public function printout()
	{
		if (isset($_POST['printout'])) 
		{
			$date = $_POST['date'];
			$cust_id = $_POST['cust_id'];

			$customer_data = $this->model->selectOne('master', ['cust_id' => $cust_id]);

			if ($customer_data) 
			{
				$name = $customer_data->cust_name;
				$station = $customer_data->cust_station;
				$transport = $customer_data->cust_transport;

				include('app/views/printout_page.php');
				exit();
			} 
			else 
			{
				echo "Error: Customer not found.";
			}
		}

		$customers = $this->model->selectData('master');

		usort
		($customers, function($a, $b) 
			{
				return strcasecmp($a->cust_name, $b->cust_name);
			}
		);
		include('app/views/printout_dropdown.php');
	}



}
?>