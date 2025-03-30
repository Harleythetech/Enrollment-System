<div>
    <div class="navbg p-3 rounded rounded-3 shadow-sm">
        <div class="d-flex justify-content-between flex-wrap align-items-center">
            <h5 class="mb-0">Semester Database</h5>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSemesterModal">Add Data <i class="bi bi-plus-lg"></i></button>
        </div>
    </div>

    <table class="table table-striped table-hover table-bordered mt-3">
        <thead>
            <tr>
                <th>Semester Code</th>
                <th>Year</th>
                <th>Term</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $enrollment_data = data_SemestersDB($pdo);
            if (count($enrollment_data) > 0) {
                foreach ($enrollment_data as $row) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['SEMESTER_CODE']) . "</td>
                            <td>" . htmlspecialchars($row['SEMESTER_YEAR']) . "</td>
                            <td>" . htmlspecialchars($row['SEMESTER_TERM']) . "</td>
                            <td>" . htmlspecialchars($row['SEMESTER_START_DATE']) . "</td>
                            <td>" . htmlspecialchars($row['SEMESTER_END_DATE']) . "</td>
                            <td>
                                <button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editSemesterModal' 
                                    data-id='" . htmlspecialchars($row['SEMESTER_CODE']) . "'
                                    data-year='" . htmlspecialchars($row['SEMESTER_YEAR']) . "'
                                    data-term='" . htmlspecialchars($row['SEMESTER_TERM']) . "'
                                    data-start='" . htmlspecialchars($row['SEMESTER_START_DATE']) . "'
                                    data-end='" . htmlspecialchars($row['SEMESTER_END_DATE']) . "'>Edit</button>
                                <a href='?page=ManageDB&subpage=SemesterDB&action=delete&id=" . htmlspecialchars($row['SEMESTER_CODE']) . "' class='btn btn-danger'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>No records found</td></tr>";
            }
        ?>
        </tbody>
    </table>
</div>

<!-- Add Semester Modal -->
<div class="modal fade" id="addSemesterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Semester</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="app/main_proc.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="add_semester">
                    <div class="mb-3">
                        <label>Semester Code</label>
                        <input type="text" name="semester_code" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Year</label>
                        <input type="text" name="semester_year" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Term</label>
                        <input type="text" name="semester_term" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Start Date</label>
                        <input type="date" name="semester_start_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>End Date</label>
                        <input type="date" name="semester_end_date" class="form-control" required>
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

<!-- Edit Semester Modal -->
<div class="modal fade" id="editSemesterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Semester</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="app/main_proc.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="edit_semester">
                    <input type="hidden" name="semester_code" id="editSemesterCode">
                    <div class="mb-3">
                        <label>Year</label>
                        <input type="text" name="semester_year" id="editSemesterYear" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Term</label>
                        <input type="text" name="semester_term" id="editSemesterTerm" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Start Date</label>
                        <input type="date" name="semester_start_date" id="editSemesterStart" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>End Date</label>
                        <input type="date" name="semester_end_date" id="editSemesterEnd" class="form-control" required>
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
    var editSemesterModal = document.getElementById('editSemesterModal');
    editSemesterModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        document.getElementById('editSemesterCode').value = button.getAttribute('data-id');
        document.getElementById('editSemesterYear').value = button.getAttribute('data-year');
        document.getElementById('editSemesterTerm').value = button.getAttribute('data-term');
        document.getElementById('editSemesterStart').value = button.getAttribute('data-start');
        document.getElementById('editSemesterEnd').value = button.getAttribute('data-end');
    });
</script>
