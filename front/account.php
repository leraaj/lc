<?php
require_once '../back/conn.php';
require_once '../back/cdn.php';
require "../front/modals.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Accounts</title>
</head>

<body class="d-flex ">
    <?php include_once '../front/nav.php'; ?>
    <aside class="col h-100 overflow-auto">
        <nav class="nav navbar py-3 shadow-sm aside-nav">
            <div class="container-fluid row mx-0">
                <div class="col"><a href="#" class="navbar-brand">Accounts</a></div>
                <div class="col d-flex justify-content-end gap-2">
                    <div class="col-auto">
                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#adduserModal">Add
                            Employee</button>
                    </div>
                    <div class="col-auto ">
                        <input type="text" class="search-bar form-control form-control-sm " placeholder="search">
                    </div>
                </div>
            </div>
        </nav>
        <div class="table-container container-fluid">
            <table class="table table-bordered table-sm table-hover text-start align-middle">
                <thead class=" table-dark text-start align-middle sticky-top">
                    <tr>
                        <th scope="col" class="col-auto py-2">Name</th>
                        <th scope="col" class="col-auto py-2">Position</th>
                        <th scope="col" class="col-auto py-2">Birth Date</th>
                        <th scope="col" class="col-auto py-2">First Day of Service</th>
                        <th scope="col" class="col-auto text-center py-2">action</th>
                    </tr>
                </thead>
                <tbody id="userTbody"></tbody>
            </table>
        </div>
    </aside>
</body>
<script>
    const userUrl = 'http://localhost/LC/back/api/User/user.php';
    // Set user data
    function setUser(id, fname, mname, lname, bdate, fdsdate, username, password, position_id) {
        user = {
            id,
            fname,
            mname,
            lname,
            bdate,
            fdsdate,
            username,
            password,
            position_id
        };
    }
    // Get user data by ID
    function getUser(id) {
        return user;
    }
    // Function to FETCH users data
    async function getUsers() {
        let table = document.getElementById('userTbody');
        table.innerHTML = ''; // Clear existing table data 
        const row = document.createElement('tr');
        try {
            const request = await fetch(userUrl, {
                method: 'GET'
            });
            const response = await request.json();
            const table = document.getElementById('userTbody');
            if (request.ok) {
                var count = 1;
                response.data.forEach(user => {
                    const row = document.createElement('tr');
                    const middleInitial = (user.mname).charAt(0);
                    const name = user.fname + " " + middleInitial + ". " + user.lname
                    row.innerHTML = ` 
                            <td>${name}</td>
                            <td class="col-1 text-capitalize">${user.position}</td>
                            <td class="col-2">${Mdy(user.bdate)}</td>
                            <td class="col-2">${Mdy(user.fdsdate)}</td> 
                            <td class="col-1 text-center">    
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-dark" onclick="updateUser(${user.id})">View</button>
                                    <button id="delete_user" class="btn btn-dark" onclick="deleteUser(${user.id})" >Delete</button>
                                </div>
                            </td> 
                        `;
                    table.appendChild(row);
                });

            } else {
                row.innerHTML = '<td colspan="5" class="text-center">Empty records</td>';
                table.appendChild(row);
                console.info("info: " + response.message);
            }
        } catch (error) {
            console.error('Error fetching data:', error);
        }
        table.appendChild(row);
    }
    // Function to FETCH users data for Update Modal
    async function updateUser(id) {
        try {
            const response = await fetch(`${userUrl}?id=${id}`, {
                method: 'GET'
            });

            if (response.ok) {
                const user = (await response.json()).data;
                const userInput = {
                    "fname": user.fname,
                    "mname": user.mname,
                    "lname": user.lname,
                    "bdate": user.bdate,
                    "fdsdate": user.fdsdate,
                    "username": user.username,
                    "password": user.password,
                    "position_id": user.position_id
                };
                for (const name in userInput) {
                    // Set the values of the form field
                    $(`#updateUser_${name}`).val(userInput[name]);
                    console.log(name + " = " + userInput[name]);
                }
                // Fetch User information   
                setUser(user.id, user.fname, user.mname, user.lname, user.bdate, user.fdsdate, user.username, user
                    .password, user.position_id);
                // Show the modal
                $('#updateuserModal').modal('show');
            } else {
                throw new Error('User not found');
            }

        } catch (error) {
            console.error('Error fetching user:', error);
        }
    }
    // Function to Add users data
    $('#addUser_form').submit(async function(event) {
        event.preventDefault();
        // Convert the array to an object
        const formDataObject = {};
        $(this).serializeArray().forEach(input => {
            formDataObject[input.name] = input.value;
        });
        // Convert the object to a JSON string with prettified formatting
        const addFormData = JSON.stringify(formDataObject, null, 2);
        console.log(addFormData)

        // Your async form handling logic here
        try {
            const response = await fetch(`${userUrl}`, {
                method: 'POST',
                body: addFormData,
            });
            const res_data = await response.json();
            if (response.ok) {
                $('#adduserModal').modal('hide');
                getUsers();
                alert('RESPONSE MESSAGE: ' + res_data.message);
            } else {
                console.log('ERROR:', response.status);
                // Handle validation errors if the response status is 400
                if (response.status === 400 && res_data.errors) {
                    console.log('VALIDATION ERRORS:');
                    res_data.errors.forEach(error => {
                        console.log(error.name + ' - ' + error.message);
                        if (error.name) {
                            var inputMessage = $(`input[id="addUser_${error.name}"]`).siblings(
                                    '.invalid-feedback')
                                .find('.message');
                            // Perform your validation or message assignment here
                            if (inputMessage.val().length === 0) {
                                inputMessage.text(error.message);
                            }
                        }
                    });
                }
            }

        } catch (error) {
            console.log(error)
        }
    });
    // Function to Update users data
    $('#updateUser_form').submit(async function(event) {
        event.preventDefault();
        const user = getUser();
        const id = user.id;
        // Convert the array to an object
        const formDataObject = {};
        $(this).serializeArray().forEach(input => {
            formDataObject[input.name] = input.value;
        });
        // Convert the object to a JSON string with prettified formatting
        const updateFormData = JSON.stringify(formDataObject, null, 2);
        console.log(updateFormData)
        // Your async form handling logic here
        try {
            const response = await fetch(`${userUrl}?id=${id}`, {
                method: 'PUT',
                body: updateFormData,
            });
            const res_data = await response.json();
            if (response.ok) {
                $('#updateuserModal').modal('hide');
                getUsers();
                alert('RESPONSE MESSAGE: ' + res_data.message);
            } else {
                console.log('ERROR:', response.status);
                // Handle validation errors if the response status is 400
                if (response.status === 400 && res_data.errors) {
                    console.log('VALIDATION ERRORS:');
                    res_data.errors.forEach(error => {
                        console.log(error.name + ' - ' + error.message);
                        if (error.name) {
                            var message = $(`#updateUser_${error.name}`).siblings(
                                    '.invalid-feedback')
                                .find('.message');
                            // Perform your validation or message assignment here
                            if (message.val().length === 0) {
                                message.text(error.message);
                            }
                        }
                    });
                }
            }
        } catch (error) {
            console.log(error)
        }
    });

    function deleteUser(id) {
        if (window.confirm("Are you sure you want to delete this user?")) {
            handleDelete(id)
        }
    }
    // Function to Delete users data
    async function handleDelete(id) {
        let table = document.getElementById('userTbody');
        table.innerHTML = ''; // Clear existing table data 
        const row = document.createElement('tr');
        try {
            const request = await fetch(`${userUrl}?id=${id}`, {
                method: 'DELETE',
            });
            const res_data = await request.json();
            const table = document.getElementById('userTbody');
            if (request.ok) {
                getUsers();
                alert('RESPONSE MESSAGE: ' + res_data.message);
            } else {
                console.log('RESPONSE ERROR:', res_data.message);
                console.log("info: " + response.message);
            }
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }
    // Functions Onload
    $(document).ready(function() {
        getUsers(); // Call the function to FETCH users 
        // Functions upon hiding MODAL
        $('.modal').on('hidden.bs.modal', function(event) {
            $("form").trigger("reset");
            $('form').removeClass('was-validated');
            $("input[name='password']").attr("type", "password");
            $("input[name='password']").attr("type", "password");
            $('.passwordToggle').find("i").removeClass("bi-eye").addClass("bi-eye-slash");
            $('.passwordToggle').removeClass("active");
        });
        $('#addUser_fname, #addUser_mname, #addUser_lname').on('keyup keydown keypress', function() {
            const fname = $('#addUser_fname').val();
            const mname = $('#addUser_mname').val();
            const lname = $('#addUser_lname').val();
            // Assuming generateUsername is a function that generates the username
            const username = generateUsername(fname, mname, lname);
            $('#addUser_username').val(username);
        });
        $(".search-bar").on("keyup keydown change click", function() {
            var value = $(this).val().toLowerCase();
            $("table > tbody > tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
            if (event.keyCode === 27) { // ESC key
                $(this).val('')
            }
        });
    })
</script>


</html>