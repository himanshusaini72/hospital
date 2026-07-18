<?php
session_start();
include 'config.php';

/* ===========================
   SESSION CHECK
=========================== */

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

/* ===========================
   SEARCH & FILTER
=========================== */

$where = "WHERE 1";
$search = "";
$day = "";

if(isset($_GET['search']) && $_GET['search'] != ""){

    $search = mysqli_real_escape_string($conn,$_GET['search']);

    $where .= " AND d.doctor_name LIKE '%$search%'";
}

if(isset($_GET['day']) && $_GET['day'] != ""){

    $day = mysqli_real_escape_string($conn,$_GET['day']);

    $where .= " AND ds.day='$day'";
}

/* ===========================
   DASHBOARD CARDS
=========================== */

$totalSchedules = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) total FROM doctor_schedule")
)['total'];

$activeSchedules = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) total FROM doctor_schedule WHERE status='Active'")
)['total'];

$inactiveSchedules = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) total FROM doctor_schedule WHERE status='Inactive'")
)['total'];

/* ===========================
   PAGINATION
=========================== */

$limit = 10;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if($page < 1){
    $page = 1;
}

$offset = ($page-1) * $limit;

$countQuery = mysqli_query($conn,
"SELECT COUNT(*) total
FROM doctor_schedule ds
INNER JOIN doctors d
ON ds.doctor_id=d.id
$where");

$totalRows = mysqli_fetch_assoc($countQuery)['total'];

$totalPages = ceil($totalRows/$limit);

/* ===========================
   FETCH SCHEDULES
=========================== */

$sql = "SELECT ds.*, d.doctor_name FROM doctor_schedule ds INNER JOIN doctors d ON ds.doctor_id=d.id $where ORDER BY ds.id DESC LIMIT $offset,$limit";

$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Schedule</title>
        <link rel="stylesheet" href="admin_style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>
                    <i class="fa-solid fa-calendar-days"></i>
                    Manage Doctor Schedule
                </h1>
                <div>
                    <a href="admin_dashboard.php" class="back-btn">
                        Dashboard
                    </a>
                    <a href="add_schedule.php" class="add-btn">
                        <i class="fa-solid fa-plus"></i>
                        Add Schedule
                    </a>
                </div>
            </div>

            <!-- Dashboard Cards -->

             <div class="cards">
                <div class="card total">
                    <h2><?php echo $totalSchedules; ?></h2>
                    <p>Total Schedule</p>
                </div>
                
                <div class="card active">
                    <h2><?php echo $activeSchedules; ?></h2>
                    <p>Active</p>
                </div>
                
                <div class="card inactive">
                    <h2><?php echo $inactiveSchedules; ?></h2>
                    <p>Inactive</p>
                </div>
            </div>
            
            <!-- Search -->
             
            <form method="GET" class="search-box">
                <input type="text" name="search" placeholder="Search Doctor..." value="<?php echo $search; ?>">
                
                <select name="day">
                    <option value="">All Days</option>
                    <option value="Monday" <?php if($day=="Monday") echo "selected"; ?>>Monday</option>
                    <option value="Tuesday" <?php if($day=="Tuesday") echo "selected"; ?>>Tuesday</option>
                    <option value="Wednesday" <?php if($day=="Wednesday") echo "selected"; ?>>Wednesday</option>
                    <option value="Thursday" <?php if($day=="Thursday") echo "selected"; ?>>Thursday</option>
                    <option value="Friday" <?php if($day=="Friday") echo "selected"; ?>>Friday</option>
                    <option value="Saturday" <?php if($day=="Saturday") echo "selected"; ?>>Saturday</option>
                    <option value="Sunday" <?php if($day=="Sunday") echo "selected"; ?>>Sunday</option>
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
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Slot</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                    ?>
                    
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['doctor_name']; ?></td>
                        <td><?php echo $row['day']; ?></td>
                        <td><?php echo date("h:i A", strtotime($row['start_time'])); ?></td>
                        <td><?php echo date("h:i A", strtotime($row['end_time'])); ?></td>
                        <td><?php echo $row['slot_duration']; ?> Min</td>
                        <td>
                            <?php
                            if($row['status']=="Active"){
                                echo "<span class='status active-status'>
                                Active
                                </span>";
                                
                                }else{
                                    echo "<span class='status inactive-status'>
                                    Inactive
                                    </span>";
                                }
                                
                            ?>
                        </td>
                        <td>                        
                            <a href="edit_schedule.php?id=<?php echo $row['id']; ?>"
                            class="edit-btn">
                            <i class="fa-solid fa-pen-to-square"></i>
                            Edit
                            </a>
                        
                            <a href="delete_schedule.php?id=<?php echo $row['id']; ?>"
                            class="delete-btn" onclick="return confirm('Are you sure you want to delete this schedule?');">
                            <i class="fa-solid fa-trash"></i>
                            Delete
                           </a>
                        </td>
                    </tr>
                    
                    <?php
                    }
                    }else{
                    ?>
                    <tr>
                        <td colspan="8" style="padding:20px; text-align:center;">
                            No Schedule Found
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            
            <!-- Pagination -->
            <div class="pagination">
                
                <?php
                if($page > 1){
                    echo "<a href='?page=".($page-1)."&search=".$search."&day=".$day."'>
                    Previous
                    </a>";
                }
                for($i=1;$i<=$totalPages;$i++){
                    if($i==$page){
                        echo "<span class='current-page'>$i</span>";
                        }else{
                            echo "<a href='?page=$i&search=$search&day=$day'>
                            $i
                            </a>";
                        }
                    }
                    if($page < $totalPages){
                        echo "<a href='?page=".($page+1)."&search=".$search."&day=".$day."'>
                        Next
                        </a>";
                    }
                ?>
            </div>
        </div>
    </body>
</html>