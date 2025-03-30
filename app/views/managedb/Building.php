<div>
    <div class="navbg p-3 rounded rounded-3 shadow-sm">
        <div class="d-flex justify-content-between flex-wrap align-items-center">
            <h5 class="mb-0">Buildings Database</h5>
            <!-- Button to open Add Modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addBuildingModal">
                Add Data <i class="bi bi-plus-lg"></i>
            </button>
        </div>
    </div>

    <table class="table table-striped table-hover table-bordered mt-3">
        <thead>
            <tr>
                <th>Building Code</th>
                <th>Name</th>
                <th>Location</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Fetch data from the database
            $building_data = data_BuildingDB($pdo);
            if (count($building_data) > 0) {
                foreach ($building_data as $row) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['BLDG_CODE']) . "</td>
                            <td>" . htmlspecialchars($row['BLDG_NAME']) . "</td>
                            <td>" . htmlspecialchars($row['BLDG_LOCATION']) . "</td>
                            <td>
                                <!-- Edit Button to open modal -->
                                <button type='button' class='btn btn-primary' data-bs-toggle='modal' 
                                    data-bs-target='#editBuildingModal' 
                                    data-id='" . htmlspecialchars($row['BLDG_CODE']) . "'
                                    data-name='" . htmlspecialchars($row['BLDG_NAME']) . "'
                                    data-location='" . htmlspecialchars($row['BLDG_LOCATION']) . "'>
                                    Edit
                                </button>
                                <a href='?page=ManageDB&subpage=Building&action=delete&id=" . htmlspecialchars($row['BLDG_CODE']) . "' 
                                    class='btn btn-danger'>
                                    Delete
                                </a>
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

<!-- ADD BUILDING MODAL -->
<div class="modal fade" id="addBuildingModal" tabindex="-1" aria-labelledby="addBuildingLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBuildingLabel">Add New Building</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="app/main_proc.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="add_building">

                    <div class="mb-3">
                        <label for="bldg_code" class="form-label">Building Code</label>
                        <input type="text" class="form-control" id="bldg_code" name="bldg_code" required>
                    </div>

                    <div class="mb-3">
                        <label for="bldg_name" class="form-label">Building Name</label>
                        <input type="text" class="form-control" id="bldg_name" name="bldg_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="bldg_location" class="form-label">Building Location</label>
                        <input type="text" class="form-control" id="bldg_location" name="bldg_location" required>
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

<!-- EDIT BUILDING MODAL -->
<div class="modal fade" id="editBuildingModal" tabindex="-1" aria-labelledby="editBuildingLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBuildingLabel">Edit Building</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="app/main_proc.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="edit_building">
                    <input type="hidden" id="edit_bldg_code" name="bldg_code">

                    <div class="mb-3">
                        <label for="edit_bldg_name" class="form-label">Building Name</label>
                        <input type="text" class="form-control" id="edit_bldg_name" name="bldg_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_bldg_location" class="form-label">Building Location</label>
                        <input type="text" class="form-control" id="edit_bldg_location" name="bldg_location" required>
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var editBuildingModal = document.getElementById('editBuildingModal');
        editBuildingModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var id = button.getAttribute('data-id');
            var name = button.getAttribute('data-name');
            var location = button.getAttribute('data-location');

            // Update modal form fields
            document.getElementById('edit_bldg_code').value = id;
            document.getElementById('edit_bldg_name').value = name;
            document.getElementById('edit_bldg_location').value = location;
        });
    });
</script>
