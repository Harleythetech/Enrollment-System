<div>
    <div class="navbg p-3 rounded rounded-3 shadow-sm">
        <div class="d-flex justify-content-between flex-wrap align-items-center">
            <h5 class="mb-0">Room Database</h5>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                Add Data <i class="bi bi-plus-lg"></i>
            </button>
        </div>
    </div>

    <table class="table table-striped table-hover table-bordered mt-3">
        <thead>
            <tr>
                <th>Room Code</th>
                <th>Room Type</th>
                <th>BLDG Code</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Fetch data from the database and display it in the table
            $room_data = data_RoomDB($pdo); // Fetch room data
            if (count($room_data) > 0) {
                foreach ($room_data as $row) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['ROOM_CODE']) . "</td>
                            <td>" . htmlspecialchars($row['ROOM_TYPE']) . "</td>
                            <td>" . htmlspecialchars($row['BLDG_CODE']) . "</td>
                            <td>
                                <button class='btn btn-primary btn-edit' 
                                    data-bs-toggle='modal' 
                                    data-bs-target='#editRoomModal' 
                                    data-room-code='" . htmlspecialchars($row['ROOM_CODE']) . "'
                                    data-room-type='" . htmlspecialchars($row['ROOM_TYPE']) . "'
                                    data-bldg-code='" . htmlspecialchars($row['BLDG_CODE']) . "'>
                                    Edit
                                </button>
                                <a href='?page=ManageDB&subpage=RoomDB&action=delete&id=" . htmlspecialchars($row['ROOM_CODE']) . "' class='btn btn-danger'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='text-center'>No records found</td></tr>";
            }
        ?>
        </tbody>
    </table>
</div>

<!-- Add Room Modal -->
<div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRoomModalLabel">Add Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="app/main_proc.php" method="POST">
                <input type="hidden" name="action" value="add_room">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="room_code" class="form-label">Room Code</label>
                        <input type="text" class="form-control" id="room_code" name="room_code" required>
                    </div>
                    <div class="mb-3">
                        <label for="room_type" class="form-label">Room Type</label>
                        <input type="text" class="form-control" id="room_type" name="room_type" required>
                    </div>
                    <div class="mb-3">
                        <label for="bldg_code" class="form-label">Building Code</label>
                        <input type="text" class="form-control" id="bldg_code" name="bldg_code" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Room Modal -->
<div class="modal fade" id="editRoomModal" tabindex="-1" aria-labelledby="editRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRoomModalLabel">Edit Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="app/main_proc.php" method="POST">
                <input type="hidden" name="action" value="edit_room">
                <input type="hidden" id="edit_room_code" name="room_code">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_room_type" class="form-label">Room Type</label>
                        <input type="text" class="form-control" id="edit_room_type" name="room_type" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_bldg_code" class="form-label">Building Code</label>
                        <input type="text" class="form-control" id="edit_bldg_code" name="bldg_code" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script to Fill Edit Modal -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const editButtons = document.querySelectorAll(".btn-edit");
    editButtons.forEach(button => {
        button.addEventListener("click", function () {
            document.getElementById("edit_room_code").value = this.getAttribute("data-room-code");
            document.getElementById("edit_room_type").value = this.getAttribute("data-room-type");
            document.getElementById("edit_bldg_code").value = this.getAttribute("data-bldg-code");
        });
    });
});
</script>
