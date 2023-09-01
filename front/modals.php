<!-- USER-ADD-Modal -->
<div class="modal fade" id="adduserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    Add Employee
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addUser_form" class="needs-validation m-0" novalidate>
                <div class="modal-body row mx-0">
                    <div class="col-12 col-lg-6 p-1">
                        <div class="input-group ">
                            <div class="input-group-text">Birth Date</div>
                            <input type="date" name="bdate" id="addUser_bdate" class="form-control " required
                                autocomplete="off">

                            <div class="invalid-feedback p-0 mt-1 mb-0 mb-0"><small class="message"></small></div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 p-1">
                        <div class="input-group ">
                            <div class="input-group-text">First Day of Service</div>
                            <input type="date" name="fdsdate" id="addUser_fdsdate" class="form-control " required
                                autocomplete="off">

                            <div class="invalid-feedback p-0 mt-1 mb-0 mb-0"><small class="message"></small></div>
                        </div>
                    </div>
                    <div class="col-12 p-1">
                        <div class="input-group ">
                            <div class="input-group-text">First name</div>
                            <input type="text" name="fname" id="addUser_fname" class="form-control " required
                                autocomplete="off">

                            <div class="invalid-feedback p-0 mt-1 mb-0"><small class="message"></small></div>
                        </div>
                    </div>
                    <div class="col-12 p-1">
                        <div class="input-group ">
                            <div class="input-group-text">Middle name</div>
                            <input type="text" name="mname" id="addUser_mname" class="form-control " required
                                autocomplete="off">

                            <div class="invalid-feedback p-0 mt-1 mb-0"><small class="message"></small></div>
                        </div>
                    </div>
                    <div class="col-12 p-1">
                        <div class="input-group ">
                            <div class="input-group-text">Last name</div>
                            <input type="text" name="lname" id="addUser_lname" class="form-control " required
                                autocomplete="off">

                            <div class="invalid-feedback p-0 mt-1 mb-0 mb-0"><small class="message"></small></div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 p-1">
                        <div class="input-group ">
                            <div class="input-group-text">Username</div>
                            <input type="text" name="username" id="addUser_username" class="form-control " required
                                autocomplete="off">

                            <div class="invalid-feedback p-0 mt-1 mb-0 mb-0"><small class="message"></small></div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 p-1">
                        <div class="input-group ">
                            <div class="input-group-text">Password</div>
                            <input type="password" name="password" id="addUser_password" class="form-control " required
                                autocomplete="off">
                            <button class="btn btn-outline-secondary passwordToggle" type="button"><i
                                    class="bi bi-eye-slash"></i></button>
                            <div class="valid-feedback p-0 mt-1 mb-0 mb-0 col-12"><small class="message">Looks
                                    good!</small></div>
                            <div class="invalid-feedback p-0 mt-1 mb-0 mb-0 col-12"><small class="message"></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 p-1">
                        <div class="input-group ">
                            <div class="input-group-text">Position</div>
                            <select class="form-select text-capitalize" name="position_id" id="addUser_position_id"
                                required autocomplete="off">
                                <option selected value="">Choose...</option>
                                <?php
                                $query = "SELECT * FROM user_type";
                                $result = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Check if the current option's value matches the desired value
                                    $isSelected = ($row['id'] == $desiredValue) ? 'selected' : '';

                                    echo '<option class="text-capitalize" value="' . $row['id'] . '" ' . $isSelected . '>' . $row['position'] . '</option>';
                                }
                                ?>
                            </select>

                            <div class="invalid-feedback p-0 mt-1 mb-0 mb-0"><small class="message">Select a
                                    position</small></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="reset" class="btn btn-danger">
                        Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Add Employee
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- USER-UPDATE-Modal -->
<div class="modal fade" id="updateuserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    Employee Information
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateUser_form" class="needs-validation m-0" novalidate>
                <input type="hidden" id="updateUser_id">
                <div class="modal-body row mx-0">
                    <div class="col-12 col-lg-6 p-1">
                        <div class="input-group ">
                            <div class="input-group-text">Birth Date</div>
                            <input type="date" name="bdate" id="updateUser_bdate" class="form-control " required
                                autocomplete="off">

                            <div class="invalid-feedback p-0 mt-1 mb-0 mb-0"><small class="message"></small></div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 p-1">
                        <div class="input-group ">
                            <div class="input-group-text">First Day of Service</div>
                            <input type="date" name="fdsdate" id="updateUser_fdsdate" class="form-control " required
                                autocomplete="off">

                            <div class="invalid-feedback p-0 mt-1 mb-0 mb-0"><small class="message"></small></div>
                        </div>
                    </div>
                    <div class="col-12 p-1">
                        <div class="input-group ">
                            <div class="input-group-text">First name</div>
                            <input type="text" name="fname" id="updateUser_fname" class="form-control " required
                                autocomplete="off">

                            <div class="invalid-feedback p-0 mt-1 mb-0"><small class="message"></small></div>
                        </div>
                    </div>
                    <div class="col-12 p-1">
                        <div class="input-group ">
                            <div class="input-group-text">Middle name</div>
                            <input type="text" name="mname" id="updateUser_mname" class="form-control " required
                                autocomplete="off">

                            <div class="invalid-feedback p-0 mt-1 mb-0"><small class="message"></small></div>
                        </div>
                    </div>
                    <div class="col-12 p-1">
                        <div class="input-group ">
                            <div class="input-group-text">Last name</div>
                            <input type="text" name="lname" id="updateUser_lname" class="form-control " required
                                autocomplete="off">

                            <div class="invalid-feedback p-0 mt-1 mb-0 mb-0"><small class="message"></small></div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 p-1">
                        <div class="input-group ">
                            <div class="input-group-text">Username</div>
                            <input type="text" name="username" id="updateUser_username" class="form-control " required
                                autocomplete="off">

                            <div class="invalid-feedback p-0 mt-1 mb-0 mb-0"><small class="message"></small></div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 p-1">
                        <div class="input-group ">
                            <div class="input-group-text">Password</div>
                            <input type="password" name="password" id="updateUser_password" class="form-control "
                                required autocomplete="off">
                            <button class="btn btn-outline-secondary passwordToggle" type="button"><i
                                    class="bi bi-eye-slash"></i></button>
                            <div class="valid-feedback p-0 mt-1 mb-0 mb-0 col-12"><small class="message">Looks
                                    good!</small></div>
                            <div class="invalid-feedback p-0 mt-1 mb-0 mb-0 col-12"><small class="message"></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 p-1">
                        <div class="input-group ">
                            <div class="input-group-text">Position</div>
                            <select class="form-select text-capitalize" name="position_id" id="updateUser_position_id"
                                aria-label="Default select example" required autocomplete="off">
                                <option disabled value="">Choose...</option>
                                <?php
                                $query = "SELECT * FROM user_type";
                                $result = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Check if the current option's value matches the desired value
                                    $isSelected = ($row['id'] == $desiredValue) ? 'selected' : '';

                                    echo '<option class="text-capitalize" value="' . $row['id'] . '" ' . $isSelected . '>' . $row['position'] . '</option>';
                                }
                                ?>
                            </select>

                            <div class="invalid-feedback p-0 mt-1 mb-0 mb-0"><small class="message"></small></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Update Information
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Leavecard-ADD-Modal -->
<div class="modal fade" id="addleaveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    Leave Card
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-0">
                <nav class="container-fluid">
                    <div class="row mx-0 gy-1 py-2">
                        <div class="col-lg-6 col-12"> <span class="fw-bold">Name: </span> <span
                                id="leavecard_name"></span> </div>
                        <div class="col-lg-6 col-12 text-lg-end"> <span class="fw-bold">Birth Date: </span> <span
                                id="leavecard_bdate"></span> </div>
                        <div class="col-lg-6 col-12"> <span class="fw-bold">School: </span> <span
                                id="leavecard_school"></span>
                        </div>
                        <div class="col-lg-6 col-12 text-lg-end"> <span class="fw-bold">First Day of Service: </span>
                            <span id="leavecard_fdsdate"></span>
                        </div>
                    </div>
                </nav>
                <div class="overflow-auto">
                    <table class="table table-bordered table-sm table-hover text-center align-middle">
                        <thead class=" text-center align-middle">
                            <tr>
                                <th scope="col">Date of Filing</th>
                                <th scope="col">Previous Balance</th>
                                <th scope="col">Earned</th>
                                <th scope="col">Used</th>
                                <th scope="col">Total Balance</th>
                                <th scope="col">Inclusive Dates</th>
                                <th scope="col">Days/Hours/Mins</th>
                                <th scope="col">Type</th>
                                <th scope="col">Remarks</th>
                                <th scope="col">action</th>
                            </tr>
                        </thead>
                        <tbody id="leavecard_viewTbody"></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-primary">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
    $(".passwordToggle").click(function() {
        var passwordInput = $("input[name='password']");
        var icon = $(this).find("i");

        if (passwordInput.attr("type") === "password") {
            passwordInput.attr("type", "text");
            icon.removeClass("bi-eye-slash").addClass("bi-eye");
            $(this).addClass("active");
        } else {
            passwordInput.attr("type", "password");
            icon.removeClass("bi-eye").addClass("bi-eye-slash");
            $(this).removeClass("active");
        }
    });
})()
</script>
<!-- Modal -->
<div class="modal fade" id="positionFilter_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Filter Position</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </div>
</div>