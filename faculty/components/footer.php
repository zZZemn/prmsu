<!-- Add New Section Modal -->
<div class="modal" tabindex="-1" role="dialog" id="addSectionModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Section</h5>
            </div>
            <form id="frmAddNewSection">
                <div class="modal-body">
                    <div>
                        <label for="sectionName">Section Name:</label>
                        <input type="text" id="sectionName" class="form-control mt-1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseAddSectionModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Add New Section Modal -->

<!-- Rename Section Modal -->
<div class="modal" tabindex="-1" role="dialog" id="RenameSectionModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rename Section</h5>
            </div>
            <form id="frmRenameSection">
                <div class="modal-body">
                    <div>
                        <label for="sectionName">Section Name:</label>
                        <input type="text" id="renameSectionName" class="form-control mt-1" required>
                    </div>
                    <input type="hidden" id="renameSectionId" value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseRenameSectionModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Rename Section Modal -->

<!-- Delete Section Modal -->
<div class="modal" tabindex="-1" role="dialog" id="deleteSectionModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Section</h5>
            </div>
            <form id="frmDeleteSection">
                <div class="modal-body">
                    <p>Are you sure you want to delete this section?</p>
                    <input type="hidden" id="deleteSectionId" required value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Delete</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseDeleteSectionModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Delete Section Modal -->


<!----------------------------------------------------------------------------->

<!-- Add New Faculty Modal -->
<div class="modal" tabindex="-1" role="dialog" id="addFacultyModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Folder</h5>
            </div>
            <form id="frmAddNewFaculty">
                <div class="modal-body">
                    <div>
                        <label for="AddFacultyName">Folder Name:</label>
                        <input type="text" id="AddFacultyName" class="form-control mt-1" required>
                        <input type="hidden" id="SectionToBeAdd" class="form-control mt-1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseAddFacultyModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Add New Faculty Modal -->

<!-- Delete Faculty Modal -->
<div class="modal" tabindex="-1" role="dialog" id="deleteFacultyModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Folder</h5>
            </div>
            <form id="frmDeleteFaculty">
                <div class="modal-body">
                    <p>Are you sure you want to delete this folder?</p>
                    <input type="hidden" id="deleteFacultyId" required value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Delete</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseDeleteFacultyModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Delete Faculty Modal -->

<!-- Rename Faculty Modal -->
<div class="modal" tabindex="-1" role="dialog" id="RenameFacultyModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rename Folder</h5>
            </div>
            <form id="frmRenameFaculty">
                <div class="modal-body">
                    <div>
                        <label for="renameFacultyName">Folder Name:</label>
                        <input type="text" id="renameFacultyName" class="form-control mt-1" required>
                    </div>
                    <input type="hidden" id="renameFacultyId" value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseRenameFacultyModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Rename Faculty Modal -->

<!----------------------------------------------------------------------------->

<!-- Add New FileFolder Modal -->
<div class="modal" tabindex="-1" role="dialog" id="addFileFolderModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Folder</h5>
            </div>
            <form id="frmAddNewFileFolder">
                <div class="modal-body">
                    <div>
                        <label for="AddFileFolderName">Folder Name:</label>
                        <input type="text" id="AddFileFolderName" class="form-control mt-1" required>
                        <input type="hidden" id="FacultyToBeAdd" class="form-control mt-1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseAddFileFolderModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Add New FileFolder Modal -->

<!-- Rename Folder Modal -->
<div class="modal" tabindex="-1" role="dialog" id="RenameFolderModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rename Folder</h5>
            </div>
            <form id="frmRenameFolder">
                <div class="modal-body">
                    <div>
                        <label for="renameFolderName">Folder Name:</label>
                        <input type="text" id="renameFolderName" class="form-control mt-1" required>
                    </div>
                    <input type="hidden" id="renameFolderId" value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseRenameFolderModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Rename Folder Modal -->

<!-- Delete FileFolder Modal -->
<div class="modal" tabindex="-1" role="dialog" id="deleteFileFolderModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Folder</h5>
            </div>
            <form id="frmDeleteFileFolder">
                <div class="modal-body">
                    <p>Are you sure you want to delete this folder?</p>
                    <input type="hidden" id="deleteFileFolderId" required value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Delete</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseDeleteFileFolderModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Delete FileFolder Modal -->


<!-- ------------------------------------------------------------ -->

<!-- Add New File Modal -->
<div class="modal" tabindex="-1" role="dialog" id="addFileModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New File</h5>
            </div>
            <form id="frmAddNewFile">
                <div class="modal-body">
                    <div>
                        <label for="file">File:</label>
                        <input type="file" id="file" name="file" class="form-control mt-1" required>
                        <input type="hidden" id="FolderToBeAdd" name="folderId" class="form-control mt-1" required>
                    </div>
                    <div>
                        <label for="notes">Notes:</label>
                        <input type="text" id="notes" name="notes" class="form-control mt-1" required>
                    </div>
                    <div>
                        <label for="tags">Tags:</label>
                        <input type="text" id="tags" name="tags" class="form-control mt-1" required>
                    </div>
                </div>
                <input type="hidden" name="submitType" value="FacultyAddNewFile">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseAddFileModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Add New File Modal -->

<!-- Edit File Modal -->
<div class="modal" tabindex="-1" role="dialog" id="editFileModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit File</h5>
            </div>
            <form id="frmEditFile">
                <div class="modal-body">
                    <div>
                        <label for="notes">Display Filename:</label>
                        <input type="text" id="editFileName" name="fileName" class="form-control mt-1" required>
                    </div>
                    <div>
                        <label for="notes">Notes:</label>
                        <input type="text" id="editNotes" name="notes" class="form-control mt-1" required>
                    </div>
                    <div>
                        <label for="tags">Tags:</label>
                        <input type="text" id="editTags" name="tags" class="form-control mt-1" required>
                    </div>
                </div>
                <input type="hidden" name="fileId" id="EditFileId" value="">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseEditFileModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit File Modal -->

<!-- Delete File Modal -->
<div class="modal" tabindex="-1" role="dialog" id="deleteFileModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete File</h5>
            </div>
            <form id="frmDeleteFile">
                <div class="modal-body">
                    <p>Are you sure you want to delete this file?</p>
                    <input type="hidden" id="deleteFileId" required value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Delete</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseDeleteFileModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Delete File Modal -->

<!-- Add New User Modal -->
<div class="modal" tabindex="-1" role="dialog" id="addNewUserModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
            </div>
            <form id="frmAddNewUser">
                <input type="hidden" name="submitType" value="AddNewUser">
                <div class="modal-body">
                    <div>
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="mt-3">
                        <label for="newUserFacultyId">Section</label>
                        <select class="form-control" id="newUserFacultyId" name="facultyId" required>
                            <option></option>
                            <?php
                            $getSections = $admin_db->getSections();
                            while ($section = $getSections->fetch_assoc()) {
                            ?>
                                <option value="<?= $section['ID'] ?>"><?= $section['SECTION_NAME'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="mt-3">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="mt-3">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Delete</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseAddNewUserModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Add New User Modal -->


<footer class="footer bg-dark p-3">
    <center>
        <a href="#" class="m-5">Contact</a>
        <a href="#" class="m-5">Privacy</a>
        <a href="#" class="m-5">Terms of Use</a>
    </center>
</footer>

<script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/app.js"></script>
</body>

</html>