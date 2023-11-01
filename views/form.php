<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>PHP App</title>
</head>

<body>
    <div class="container col-lg-5 col-sm-6 col-8">
        <h3 class="text-center mt-4">Form</h3>
        <form action="submit-form" method="post" onsubmit="return validateForm()">
            <div class="form-group">
                <label>Employee Code</label>
                <input type="number" name="emp_code" class="form-control" id="" placeholder="Enter employee code">
            </div>
            <div class="form-group">
                <label>Employee Name</label>
                <input type="text" name="emp_name" class="form-control" id="" placeholder="Enter employee name">
            </div>
            <div class="form-group">
                <label>Employee Phone</label>
                <input type="number" name="emp_phone" class="form-control" id="" placeholder="Enter employee number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;">
            </div>
            <div class="form-group">
                <label>Employee Email</label>
                <input type="email" name="emp_email" class="form-control" id="" placeholder="Enter employee email">
            </div>
            <div id="error"></div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="container mt-4">
        <?php if (empty($data)) : ?>
            <h4 class="text-center">Record not found</h4>
        <?php else : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Employee Code</th>
                        <th>Employee Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $row) : ?>
                        <tr>
                            <td><?= $row['emp_code']; ?></td>
                            <td><?= $row['emp_name']; ?></td>
                            <td><?= $row['emp_phone']; ?></td>
                            <td><?= $row['emp_email']; ?></td>
                            <td>
                                <button data-id="<?= $row['id']; ?>" type="button" class="btn btn-danger" id="delete">
                                    Delete
                                </button>
                                <button data-id="<?= $row['id']; ?>" type="button" class="btn btn-primary" id="edit" data-toggle="modal" data-target="#myModal">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Employee Data</h5>
                </div>
                <div class="modal-body">
                    <form action="edit-form" method="post">
                        <input type="number" value="" name="id" id="id" hidden>
                        <div class="form-group">
                            <label>Employee Code</label>
                            <input type="number" name="emp_code" class="form-control" id="edit_code" placeholder="Enter employee code">
                        </div>
                        <div class="form-group">
                            <label>Employee Name</label>
                            <input type="text" name="emp_name" class="form-control" id="edit_name" placeholder="Enter employee name">
                        </div>
                        <div class="form-group">
                            <label>Employee Phone</label>
                            <input type="number" name="emp_phone" class="form-control" id="edit_phone" placeholder="Enter employee number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;">
                        </div>
                        <div class="form-group">
                            <label>Employee Email</label>
                            <input type="email" name="emp_email" class="form-control" id="edit_email" placeholder="Enter employee email">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    document.querySelectorAll('#edit').forEach(function(button) {
        button.addEventListener('click', function() {
            var dataId = this.getAttribute("data-id");
            document.getElementById("id").value = dataId;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var data = JSON.parse(xhr.responseText);
                        document.getElementById("edit_name").value = data.emp_name;
                        document.getElementById("edit_email").value = data.emp_email;
                        document.getElementById("edit_code").value = data.emp_code;
                        document.getElementById("edit_phone").value = data.emp_phone;
                    } else {
                        console.error("Error fetching data:", xhr.status);
                    }
                }
            };
            xhr.open("GET", "get_data.php?id=" + dataId, true);
            xhr.send();
        });
    });
    document.querySelectorAll('#delete').forEach(function(button) {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            var confirmed = confirm('Are you sure you want to delete');

            if (confirmed) {
                window.location.href = 'delete.php?id=' + id;
            }
        });
    });

    function validateForm() {
        var inputs = document.querySelectorAll('input');
        var errorDiv = document.getElementById("error");
        errorDiv.innerHTML = "";

        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].type !== "submit" && inputs[i].value.trim() === "") {
                errorDiv.innerHTML = "Something went wrong";
                inputs[i].style.border = "2px solid red";
            } else {
                inputs[i].style.border = "";
            }
        }

        if (errorDiv.innerHTML !== "") {
            errorDiv.style.color = "red";
            return false;
        }
    }
</script>

</html>