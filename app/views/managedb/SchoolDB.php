<div>
    <div class="navbg p-3 rounded rounded-3 shadow-sm">
        <div class="d-flex justify-content-between flex-wrap align-items-center">
        <h5 class="mb-0">School Database</h5>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSchoolModal">Add Data <i class="bi bi-plus-lg"></i></button>
        </div>
    </div>

    <table class="table table-striped table-hover table-bordered mt-3">
        <thead>
            <tr>
                <th>School Code</th>
                <th>Name</th>
                <th>Professor ID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $enrollment_data = data_SchoolDB($pdo);
            if (count($enrollment_data) > 0) {
                foreach ($enrollment_data as $row) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['SCHOOL_CODE']) . "</td>
                            <td>" . htmlspecialchars($row['SCHOOL_NAME']) . "</td>
                            <td>" . htmlspecialchars($row['PROF_NUM']) . "</td>
                            <td>
                                <button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editSchoolModal' 
                                    data-id='" . htmlspecialchars($row['SCHOOL_CODE']) . "' 
                                    data-name='" . htmlspecialchars($row['SCHOOL_NAME']) . "' 
                                    data-prof='" . htmlspecialchars($row['PROF_NUM']) . "'>Edit</button>
                                <a href='?page=ManageDB&subpage=SchoolDB&action=delete&id=" . htmlspecialchars($row['SCHOOL_CODE']) . "' class='btn btn-danger'>Delete</a>
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

<!-- Add School Modal -->
<div class="modal fade" id="addSchoolModal" tabindex="-1" aria-labelledby="addSchoolLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSchoolLabel">Add School</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="app/main_proc.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="add_school">
                    <div class="mb-3">
                        <label class="form-label">School Code</label>
                        <input type="text" class="form-control" name="school_code" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="school_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Professor ID</label>
                        <input type="text" class="form-control" name="prof_num" required>
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

<!-- Edit School Modal -->
<div class="modal fade" id="editSchoolModal" tabindex="-1" aria-labelledby="editSchoolLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSchoolLabel">Edit School</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="app/main_proc.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="edit_school">
                    <input type="hidden" name="school_code" id="edit_school_code">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="school_name" id="edit_school_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Professor ID</label>
                        <input type="text" class="form-control" name="prof_num" id="edit_prof_num" required>
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
document.addEventListener("DOMContentLoaded", function() {
    let editModal = document.getElementById("editSchoolModal");
    editModal.addEventListener("show.bs.modal", function(event) {
        let button = event.relatedTarget;
        document.getElementById("edit_school_code").value = button.getAttribute("data-id");
        document.getElementById("edit_school_name").value = button.getAttribute("data-name");
        document.getElementById("edit_prof_num").value = button.getAttribute("data-prof");
    });
});
</script>
