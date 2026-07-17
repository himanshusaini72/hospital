<?php
session_start();
include 'config.php';

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

/* ===========================
   SEARCH & FILTER
=========================== */

$where = "WHERE 1";

$search = "";
$status = "";

if(isset($_GET['search']) && $_GET['search'] != "")
{
    $search = mysqli_real_escape_string($conn,$_GET['search']);

    $where .= " AND (
        doctor_name LIKE '%$search%'
        OR specialization LIKE '%$search%'
    )";
}

if(isset($_GET['status']) && $_GET['status'] != "")
{
    $status = mysqli_real_escape_string($conn,$_GET['status']);

    $where .= " AND status='$status'";
}

/* ===========================
   DASHBOARD CARDS
=========================== */

$totalDoctors = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) total FROM doctors")
)['total'];

$activeDoctors = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) total FROM doctors WHERE status='Active'")
)['total'];

$inactiveDoctors = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) total FROM doctors WHERE status='Inactive'")
)['total'];

/* ===========================
   PAGINATION
=========================== */

$limit = 10;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if($page < 1){
    $page = 1;
}

$offset = ($page - 1) * $limit;

$totalRows = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) total FROM doctors $where")
)['total'];

$totalPages = ceil($totalRows / $limit);

/* ===========================
   FETCH DOCTORS
=========================== */

$sql = "SELECT *
        FROM doctors
        $where
        ORDER BY id DESC
        LIMIT $offset,$limit";

$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
    <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Manage Doctors</title>
            <link rel="stylesheet" href="admin_style.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
            <link rel="stylesheet" href="admin_style.css">
        </head>

        <body>

            <div class="container">
                <div class="header">

                    <h1>
                        <i class="fa-solid fa-user-doctor"></i>
                        Manage Doctors
                    </h1>

                        <div>
                            <a href="admin_dashboard.php" class="back-btn">
                            Dashboard
                            </a>
                            <a href="add_doctor.php" class="add-btn">
                                <i class="fa-solid fa-plus"></i>
                                Add Doctor
                            </a>

                        </div>

                </div>

<!-- Dashboard Cards -->

                <div class="cards">
                    <div class="card total">

                        <h2><?php echo $totalDoctors; ?></h2>
                            <p>Total Doctors</p>
                    </div>

                    <div class="card active">
                        <h2><?php echo $activeDoctors; ?></h2>
                        <p>Active Doctors</p>
                    </div>

                    <div class="card inactive">
                        <h2><?php echo $inactiveDoctors; ?></h2>
                        <p>Inactive Doctors</p>
                    </div>

            </div>

<!-- Search Form -->

<form method="GET" class="search-box">

    <input type="text" name="search" placeholder="Search Doctor..." value="<?php echo $search; ?>">

    <select name="status">
        <option value="">All Status</option>

        <option value="Active" <?php if($status=="Active") echo "selected"; ?>> Active </option>

        <option value="Inactive" <?php if($status=="Inactive") echo "selected"; ?>> Inactive </option>
    </select>

    <button type="submit">
        <i class="fa-solid fa-magnifying-glass"></i>
            Search
    </button>

</form>

<table>
    <thead>
        <tr>
            <th>ID</th> 
            <th>Doctor Name</th>
            <th>Specialization</th>
            <th>Experience</th>
            <th>Fees</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>

        </tr>

    </thead>

<tbody>

<?php

if(mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){

        echo "<tr>

            <td>".$row['id']."</td>

            <td>".$row['doctor_name']."</td>

            <td>".$row['specialization']."</td>

            <td>".$row['experience']." Years</td>

            <td>₹ ".$row['fees']."</td>

            <td>".$row['phone']."</td>

            <td>".$row['email']."</td>

            <td>";

            if($row['status']=="Active"){

                echo "<span class='status active-status'>
                        Active
                      </span>";

            }else{

                echo "<span class='status inactive-status'>
                        Inactive
                      </span>";

            }

        echo "</td>

        <td>

            <a href='edit_doctor.php?id=".$row['id']."'
               class='edit-btn'>
               <i class='fa-solid fa-pen-to-square'></i>
               Edit
            </a>

            <a href='delete_doctor.php?id=".$row['id']."'
               class='delete-btn'
               onclick='return confirm(\"Are you sure you want to delete this doctor?\")'>
               <i class='fa-solid fa-trash'></i>
               Delete
            </a>

        </td>

        </tr>";

    }

}else{
    echo "<tr> <td colspan='9' style='padding:25px;'> No Doctors Found </td></tr>";
    }

?>

</tbody>

</table>


<!-- Pagination -->

<div class="pagination">

<?php

if($page > 1){

    echo "<a href='?page=".($page-1)."&search=".$search."&status=".$status."'> Previous </a>";
    }

for($i=1;$i<=$totalPages;$i++){

if($i==$page){
    echo "<span class='current-page'>$i</span>";
    }else{
        
    echo "<a href='?page=$i&search=$search&status=$status'> $i </a>";
    }
    
}

if($page < $totalPages){

echo "<a href='?page=".($page+1)."&search=".$search."&status=".$status."'> Next </a>";

}

?>

</div>
</div>
</body>

</html>