<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-lg p-4">
        <h4 class="text-center mb-4">User Registration</h4>
        <form action="registerUser.php" method="POST">
          
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="Username" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="Password" required>
          </div>

          <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="Name" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="Email" required>
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="number" class="form-control" id="phone" name="PhoneNumber" required>
          </div>

          <div class="mb-3">
            <label for="usertype" class="form-label">User Type</label>
            <select class="form-select" id="usertype" name="UserType" required>
              <option value="1">Admin</option>
              <option value="2">Regular User</option>
            </select>
          </div>

          <input type="hidden" name="status" value="1">
          <input type="hidden" name="Flag" value="1">

          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Register</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

</body>
<script>
    document.getElementById("planForm").addEventListener("submit", function(event) {
      event.preventDefault(); // Prevent the form from submitting the traditional way

      // Retrieve form values
      var sPlanName = document.getElementById("planName").value;
      var sSaveAmount = document.getElementById("saveAmount").value;
      var iFrequency = document.getElementById("frequency").value;
      var iNumberOfFrequency = document.getElementById("number_of_frequency").value;
      var sStartDate = document.getElementById("startdate").value;
      var sPayingAmount = document.getElementById("payingAmount").value;
      var sNotification = document.getElementById("notification").value;

      // Prepare data for POST
      var data = `sPlanName=${encodeURIComponent(sPlanName)}&sSaveAmount=${encodeURIComponent(sSaveAmount)}&iFrequency=${encodeURIComponent(iFrequency)}&iNumberOfFrequency=${encodeURIComponent(iNumberOfFrequency)}&sStartDate=${encodeURIComponent(sStartDate)}&sPayingAmount=${encodeURIComponent(sPayingAmount)}&sNotification=${encodeURIComponent(sNotification)}`;

      // Send data via AJAX
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "ajaxMoney.php?sFlag=addPlan", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          console.log(xhr.responseText); // Handle success here
        }
      };

      xhr.send(data);
    });

    document.addEventListener("DOMContentLoaded", function() {
      const dateInput = document.getElementById("startdate");
      dateInput.valueAsDate = new Date();
    });
</script>
</html>
