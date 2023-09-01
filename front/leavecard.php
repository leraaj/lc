<?php
require_once '../back/conn.php';
require_once '../back/cdn.php';
include_once "../front/modals.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
</head>

<body class="d-flex">
    <?php include_once '../front/nav.php'; ?>
    <aside class="col h-100 overflow-auto">
        <nav class="nav navbar py-3 shadow-sm aside-nav">
            <div class="container-fluid row mx-0">
                <div class="col"><a href="#" class="navbar-brand">Leavecard</a></div>
                <div class="col d-flex justify-content-end gap-2">
                    <div class="col-auto ">
                        <input type="text" class="search-bar form-control form-control-sm " placeholder="search">
                    </div>
                </div>
            </div>
        </nav>
        <div class="table-container container-fluid">
            <table class="table table-bordered table-sm table-hover text-start align-middle">
                <thead class=" table-dark  text-start align-middle sticky-top">
                    <tr>
                        <th scope="col" class="col-auto py-2">Name</th>
                        <th scope="col" class="col-auto py-2">Position</th>
                        <th scope="col" class="col-auto py-2">Birth Date</th>
                        <th scope="col" class="col-auto py-2">First Day of Service</th>
                        <th scope="col" class="col-auto text-center py-2">action</th>
                    </tr>
                </thead>
                <tbody id="leavecardTbody"></tbody>
            </table>
        </div>
    </aside>
</body>
<script>
const userUrl = 'http://localhost/LC/back/api/User/user.php';
const leavecardUrl = 'http://localhost/LC/back/api/leavecard/leavecard.php';
// DISPLAY FETCHES
async function getUsers() {
    let table = document.getElementById('leavecardTbody');
    table.innerHTML = ''; // Clear existing table data 
    const row = document.createElement('tr');
    try {
        const request = await fetch(userUrl, {
            method: 'GET'
        });
        const response = await request.json();
        const table = document.getElementById('leavecardTbody');
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
                                    <button class="btn btn-dark" onclick="viewRecord(${user.id})">View</button>
                                    <button id="delete_user" class="btn btn-dark" onclick="generateRecord(${user.id})" >Generate</button>
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

async function fetchLeavecardRecord(user_id) {
    try {
        const response = await fetch(leavecardUrl + '?id=' + user_id, {
            method: 'GET'
        });
        const table = document.getElementById('leavecard_viewTbody');
        const row = document.createElement('tr');
        if (response.ok) {
            const leavecardRecord = (await response.json()).data;
            if (leavecardRecord.length > 0) {
                leavecardRecord.forEach((leavecard, index) => {
                    const row = document.createElement('tr'); // Create a new table row for each record

                    row.innerHTML = ` 
                    <td class="col-1">${leavecard.dateoffiling}</td> 
                    <td class="col">${leavecard.previousbalance}</td> 
                    <td class="col">${leavecard.earned}</td> 
                    <td class="col">${leavecard.used}</td> 
                    <td class="col">${leavecard.totalbalance}</td> 
                    <td class="col-2 text-start">${leavecard.inclusivedates}</td> 
                    <td class="col-2 text-start">${leavecard.dhm}</td> 
                    <td class="col-1">${leavecard.leavetype_type}</td> 
                    <td class="col-3 text-start">${leavecard.remarks}</td>  
                    <td class="col-auto text-center ${index === leavecardRecord.length - 1 ? 'action-button' : ''}">
                        ${index === leavecardRecord.length - 1 ? 
                            `<button class="btn btn-sm btn-danger" onclick="deleteRecord(${leavecard.leavecard_id})">Delete</button>` : ''
                        }
                    </td>`;
                    table.appendChild(row); // Append the new row to the table
                });
            } else {
                row.innerHTML = `<td colspan="10">User doesn't have a Leave Card Record yet!</td>`;
                table.appendChild(row);
                console.log('RESPONSE MESSAGE:', response.message);
            }
        } else {
            console.log('RESPONSE ERROR:', response.message);
        }
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

async function fetchUserRecord(user_id) {
    try {
        const request = await fetch(`${userUrl}?id=${user_id}`, {
            method: 'GET'
        });
        const response = await request.json();
        const user = response.data;
        setUser(user.id, user.fname, user.mname, user.lname, user.bdate, user.fdsdate)
        const name = user.fname + " " + user.mname + ". " + user.lname;
        $('#leavecard_name').html(name)
        $('#leavecard_bdate').html(Mdy(user.bdate))
        $('#leavecard_school').html('Carlos L. Albert High School')
        $('#leavecard_fdsdate').html(Mdy(user.fdsdate))
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}
// CRUD FUNCTIONS
async function viewRecord(user_id) {
    fetchUserRecord(user_id);
    fetchLeavecardRecord(user_id)
    $('#addleaveModal').modal('show')
}
async function deleteRecord(leavecard_id) {
    if (window.confirm("Are you sure you want to delete this record?")) {
        handleDelete(leavecard_id)
    }
}

async function handleDelete(leavecard_id) {

    const table = $('#leavecard_viewTbody')
    table.empty()
    try {
        const request = await fetch(leavecardUrl + `?id=` + leavecard_id, {
            method: 'DELETE',
        });
        const response = await request.json();
        if (request.ok) {
            viewRecord(getUser().id)
            alert('RESPONSE MESSAGE: ' + response.message);
        } else {
            console.log('RESPONSE ERROR:', response.message);
        }
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}
$(document).ready(function() {
    getUsers();
    $(".search-bar").on("keyup keydown change click", function() {
        var value = $(this).val().toLowerCase();
        $("table > tbody > tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
        if (event.keyCode === 27) { // ESC key
            $(this).val('')
        }
    });
});
$('.modal').on('hidden.bs.modal', function(event) {
    $('#leavecard_viewTbody').empty();
});

function setUser(id, fname, mname, lname, bdate, fdsdate) {
    user = {
        id,
        fname,
        mname,
        lname,
        bdate,
        fdsdate
    };
}
// Get user data by ID
function getUser(id) {
    return user;
}
</script>

</html>