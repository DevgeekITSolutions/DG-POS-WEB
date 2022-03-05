<?php
include '../../resources/conn.php';
include '../../resources/functions.php';
$user_guid = $_POST['id'];
$sql = "SELECT store_name, store_id, active FROM admin_outlets WHERE user_guid = '".$user_guid."' ";
$result = query($sql);

echo '<div class="table-responsive">
        <table class="table m-0">
            <thead>
                <tr>
                  <th>Store Name</th>
                  <th>Sales</th>
                  <th>Status</th>
                </tr>
            </thead>
            <tbody>';

while($row = mysqli_fetch_assoc($result)) {
	$status = ($row["active"] == 1) ?  "badge badge-info" :  "badge badge-success";
	$activated = ($row["active"] == 1) ?  "Available" :  "Pos Activated";
	echo '<tr>
                <td>'.$row['store_name'].'</td>
                <td>'.getTotalSales($user_guid,$row['store_id']).'</td>
                <td><span class="'.$status.'">'.$activated.'</span></td>
          </tr>';
}

echo '		</tbody>
        </table>
    </div>';

?>
