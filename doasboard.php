<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Plans</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    .piggy-card {
      margin: 30px auto;
      border-radius: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }
    .piggy-header {
      background: #fce7f3;
      padding: 20px;
      text-align: center;
    }
    .piggy-header i {
      font-size: 60px;
      color: #e83e8c;
    }
    .coin-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      padding: 20px;
      justify-content: center;
    }
    .coin {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      background-color: #ffc107;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      font-weight: bold;
      font-size: 14px;
      color: #000;
      position: relative;
      cursor: pointer;
      box-shadow: 0 2px 6px rgba(0,0,0,0.15);
      transition: transform 0.2s;
    }
    .coin:hover {
      transform: scale(1.05);
    }
    .coin.paid {
      background-color: #198754;
      color: #fff;
    }
    .coin .date {
      font-size: 10px;
      position: absolute;
      bottom: 5px;
    }
    .legend {
      font-size: 14px;
      text-align: center;
      margin-top: 10px;
    }
    .legend span {
      display: inline-block;
      width: 14px;
      height: 14px;
      border-radius: 50%;
      margin-right: 5px;
    }
    .legend .paid { background-color: #198754; }
    .legend .pending { background-color: #ffc107; }
  </style>
</head>
<body class="bg-light">

<div class="container mt-4">
  <div id="planContainer"></div>

  <div class="text-center mt-4">
    <a href="addMoneyPage.php">
      <button type="button" class="btn btn-primary">Add New Plan</button>
    </a>
  </div>
</div>

<!-- Payment Confirmation Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="paymentModalLabel">Confirm Payment</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="paymentModalBody">
        <!-- JS will populate this -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success" id="confirmPayBtn">Pay</button>
      </div>
    </div>
  </div>
</div>

<script>
let currentPaymentData = null;

window.onload = function () {
  const iUserid = 1;
  const data1 = `iPlanSaveid=${encodeURIComponent(iUserid)}`;

  const xhr1 = new XMLHttpRequest();
  xhr1.open("POST", "ajaxMoney.php?sFlag=getSavePlanDetails", true);
  xhr1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr1.onreadystatechange = function () {
    if (xhr1.readyState === 4 && xhr1.status === 200) {
      try {
        const plansList = JSON.parse(xhr1.responseText);
        const planContainer = document.getElementById('planContainer');
        planContainer.innerHTML = '';

        plansList.forEach(function (planItem) {
          const planId = planItem.id;
          const data2 = `iUserid=${encodeURIComponent(planId)}`;

          const xhr2 = new XMLHttpRequest();
          xhr2.open("POST", "ajaxMoney.php?sFlag=getplan", true);
          xhr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

          xhr2.onreadystatechange = function () {
            if (xhr2.readyState === 4 && xhr2.status === 200) {
              try {
                const planData = JSON.parse(xhr2.responseText);
                if (planData.length > 0) {
                  const planName = planData[0].plan_name;

                  let coinHTML = `<div class="card piggy-card">
                    <div class="piggy-header">
                      <i class="bi bi-piggy-bank"></i>
                      <h4 class="mt-2">${planName}</h4>
                      <div class="legend">
                        <span class="paid"></span> Paid &nbsp;&nbsp;
                        <span class="pending"></span> Pending
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="coin-grid">`;

                  planData.forEach(function (entry) {
                    const paidClass = entry.flag == 1 ? "paid" : "";
                    const date = entry.save_date;
                    const amount = entry.save_amount;

                    coinHTML += `
                      <div class="coin ${paidClass}" title="₹${amount} on ${date}"
                        onclick="showPaymentModal(${entry.id}, ${entry.user_id}, ${entry.plan_id}, ${amount})">
                        ₹${amount}
                        <div class="date">${date}</div>
                      </div>`;
                  });

                  coinHTML += `</div></div></div><br/>`;
                  planContainer.innerHTML += coinHTML;
                }
              } catch (e) {
                console.error("Invalid JSON from getplan", e);
              }
            }
          };
          xhr2.send(data2);
        });

      } catch (e) {
        console.error("Invalid JSON from getSavePlanDetails", e);
      }
    }
  };
  xhr1.send(data1);
};

function showPaymentModal(id, userid, planid, amount) {
  currentPaymentData = { id, userid, planid, amount };
  document.getElementById('paymentModalBody').innerHTML = `Do you want to pay <strong>₹${amount}</strong>?`;

  const modal = new bootstrap.Modal(document.getElementById('paymentModal'));
  modal.show();
}

document.getElementById('confirmPayBtn').addEventListener('click', function () {
  if (!currentPaymentData) return;

  const { id, userid, planid, amount } = currentPaymentData;

  const data = `iUserid=${encodeURIComponent(userid)}&iId=${encodeURIComponent(id)}&iPlanid=${encodeURIComponent(planid)}&iAmount=${encodeURIComponent(amount)}`;
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "ajaxMoney.php?sFlag=PayingMoney", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      console.log("Payment response:", xhr.responseText);
      location.reload();
    }
  };
  xhr.send(data);
});
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
