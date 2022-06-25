<?php
	include 'includes/session.php';

	$conn = $pdo->open();

	$output = array('error'=>false);

	if(isset($_SESSION['user'])){
		try{
			$stmt = $conn->prepare(" DELETE  FROM cart");
			$stmt->execute();
			header('location: checkout.php');

			
		}
		catch(PDOException $e){
			$output['message'] = $e->getMessage();
		}
	}
	else{
		foreach($_SESSION['cart'] as $key => $row){
			if($row['productid'] == $id){
				unset($_SESSION['cart'][$key]);
				$output['message'] = 'Deleted';
			}
		}
	}

	$pdo->close();
	echo json_encode($output);

?>
