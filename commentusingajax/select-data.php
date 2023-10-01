<!--select-data.php -->
<?php
include 'config.php';
$sql = "SELECT * FROM msg ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <div class="card mb-4">
            <div class="card-body">
                <p><?php echo $row['msg']; ?></p>
                <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row align-items-center">
                        <img src="https://i.imgur.com/RpzrMR2.jpg" alt="avatar" width="25" height="25" />
                        <p class="small mb-0 ms-2"><?php echo $row['name']; ?></p>
                    </div>
                </div>
            </div>
        </div>
<?php }
} ?>