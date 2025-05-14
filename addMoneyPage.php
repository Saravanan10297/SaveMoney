<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Plan</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4">Add Plan</h2>
    <form id="planForm">
      <div class="mb-3">
        <label for="planName" class="form-label">Plan Name:</label>
        <input type="text" class="form-control" id="planName" name="planName" required>
      </div>

      <div class="mb-3">
        <label for="saveAmount" class="form-label">Saving Amount:</label>
        <input type="number" class="form-control" id="saveAmount" name="saveAmount" required>
      </div>

      <div class="mb-3">
        <label for="frequency" class="form-label">Frequency:</label>
        <select id="frequency" name="frequency" class="form-select" required>
          <option value="1">Daily</option>
          <option value="7">Weekly</option>
          <option value="14">Bi-Weekly</option>
          <option value="30">Monthly</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="number_of_frequency" class="form-label">Number of Frequencies:</label>
        <input type="number" class="form-control" id="number_of_frequency" name="number_of_frequency" required>
      </div>

      <div class="mb-3">
        <label for="startdate" class="form-label">Start Date:</label>
        <input type="date" class="form-control" id="startdate" name="startdate" required>
      </div>

      <div class="mb-3">
        <label for="payingAmount" class="form-label">Paying Amount:</label>
        <input type="number" class="form-control" id="payingAmount" name="payingAmount" required>
      </div>

      <div class="mb-3">
        <label for="notification" class="form-label">Notification:</label>
        <select id="notification" name="notification" class="form-select" required>
          <option value="morning">Morning</option>
          <option value="evening">Evening</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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
</body>
</html>
