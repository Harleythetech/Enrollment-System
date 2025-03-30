<div>
    <div class="navbg p-3 rounded rounded-3 shadow-sm">
        <div class="d-flex justify-content-between flex-wrap align-items-center">
            <h5 class="mb-0">Employee / Professors Database</h5>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProfModal">Add Data <i class="bi bi-plus-lg"></i></button>
        </div>
    </div>

    <table class="table table-striped table-hover table-bordered mt-3">
        <thead>
            <tr>
                <th>Professor ID</th>
                <th>Specialty</th>
                <th>Rank</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Initial</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $professors_data = data_professorsDB($pdo);
            if (count($professors_data) > 0) {
                foreach ($professors_data as $row) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['PROF_NUM']) . "</td>
                            <td>" . htmlspecialchars($row['PROF_SPECIALTY']) . "</td>
                            <td>" . htmlspecialchars($row['PROF_RANK']) . "</td>
                            <td>" . htmlspecialchars($row['PROF_LNAME']) . "</td>
                            <td>" . htmlspecialchars($row['PROF_FNAME']) . "</td>
                            <td>" . htmlspecialchars($row['PROF_INITIAL']) . "</td>
                            <td>" . htmlspecialchars($row['PROF_EMAIL']) . "</td>
                            <td>
                                <button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editProfModal' 
                                    data-id='" . htmlspecialchars($row['PROF_NUM']) . "' 
                                    data-specialty='" . htmlspecialchars($row['PROF_SPECIALTY']) . "'
                                    data-rank='" . htmlspecialchars($row['PROF_RANK']) . "'
                                    data-lname='" . htmlspecialchars($row['PROF_LNAME']) . "'
                                    data-fname='" . htmlspecialchars($row['PROF_FNAME']) . "'
                                    data-initial='" . htmlspecialchars($row['PROF_INITIAL']) . "'
                                    data-email='" . htmlspecialchars($row['PROF_EMAIL']) . "'>Edit</button>
                                <a href='?page=ManageDB&subpage=ProfDB&action=delete&id=" . htmlspecialchars($row['PROF_NUM']) . "' class='btn btn-danger'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='8' class='text-center'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Add Professor Modal -->
<div class="modal fade" id="addProfModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Professor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="app/main_proc.php" method="POST">
                    <input type="hidden" name="action" value="add_professor">
                    <div class="mb-3">
                        <label class="form-label">Professor ID</label>
                        <input type="text" class="form-control" name="prof_num" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Specialty</label>
                        <input type="text" class="form-control" name="prof_specialty" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rank</label>
                        <input type="text" class="form-control" name="prof_rank" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="prof_lname" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" name="prof_fname" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Initial</label>
                        <input type="text" class="form-control" name="prof_initial">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="prof_email" required>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Professor Modal -->
<div class="modal fade" id="editProfModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Professor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="app/main_proc.php" method="POST">
                    <input type="hidden" name="action" value="edit_professor">
                    <input type="hidden" name="prof_num" id="editProfID">
                    <div class="mb-3">
                        <label class="form-label">Specialty</label>
                        <input type="text" class="form-control" name="prof_specialty" id="editProfSpecialty" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rank</label>
                        <input type="text" class="form-control" name="prof_rank" id="editProfRank" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="prof_lname" id="editProfLname" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" name="prof_fname" id="editProfFname" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Initial</label>
                        <input type="text" class="form-control" name="prof_initial" id="editProfInitial">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="prof_email" id="editProfEmail" required>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var editProfModal = document.getElementById('editProfModal');
    editProfModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        document.getElementById('editProfID').value = button.getAttribute('data-id');
        document.getElementById('editProfSpecialty').value = button.getAttribute('data-specialty');
        document.getElementById('editProfRank').value = button.getAttribute('data-rank');
        document.getElementById('editProfLname').value = button.getAttribute('data-lname');
        document.getElementById('editProfFname').value = button.getAttribute('data-fname');
        document.getElementById('editProfInitial').value = button.getAttribute('data-initial');
        document.getElementById('editProfEmail').value = button.getAttribute('data-email');
    });
</script>
