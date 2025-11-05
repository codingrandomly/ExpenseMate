document.addEventListener("DOMContentLoaded", () => {
  fetchDashboardData();
});

function fetchDashboardData() {
  fetch("../src/api/get_dashboard_data.php")
    .then((response) => response.json())
    .then((data) => updateDashboard(data))
    .catch((error) => {
      console.error("Error fetching dashboard data:", error);
      showErrorState();
    });
}

function updateDashboard(data) {
  const cards = {
    today: document.querySelector("#today-expense"),
    yesterday: document.querySelector("#yesterday-expense"),
    week: document.querySelector("#week-expense"),
    month: document.querySelector("#month-expense"),
    year: document.querySelector("#year-expense"),
    total: document.querySelector("#total-expense"),
  };

  if (!data || data.error) {
    showErrorState();
    return;
  }


  cards.today.textContent = `₹${data.today || 0}`;
  cards.yesterday.textContent = `₹${data.yesterday || 0}`;
  cards.week.textContent = `₹${data.week || 0}`;
  cards.month.textContent = `₹${data.month || 0}`;
  cards.year.textContent = `₹${data.year || 0}`;
  cards.total.textContent = `₹${data.total || 0}`;
}


function showErrorState() {
  const expenseValues = document.querySelectorAll(".expense-value");
  expenseValues.forEach((el) => {
    el.textContent = "Error";
    el.style.color = "#ff6b6b";
  });
}
