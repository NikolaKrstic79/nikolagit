document.addEventListener("DOMContentLoaded", function () {
    const budgetForm = document.getElementById("budget-form");
    const expenseForm = document.getElementById("expense-form");
    const budgetInput = document.getElementById("budget-input");
    const expenseTitleInput = document.getElementById("expense-input");
    const expenseValueInput = document.getElementById("amount-input");
    const budgetAmount = document.getElementById("budget-amount");
    const expenseAmount = document.getElementById("expense-amount");
    const balanceAmount = document.getElementById("balance-amount");
    const budgetFeedback = document.querySelector(".budget-feedback");
    const expenseFeedback = document.querySelector(".expense-feedback");
    const expenseTable = document.getElementById("expense-table");

    let totalBudget = 0;
    let totalExpense = 0;
    let balance = 0;

    budgetForm.addEventListener("submit", function (event) {
        event.preventDefault();
        const budgetValue = parseFloat(budgetInput.value);

        // Validate input
        if (budgetInput.value === "" || budgetValue < 0) { // Fixed the syntax error here
            $(".budget-feedback").text("Value cannot be empty or negative").show();
            return;
        }

        totalBudget = budgetValue;
        balance = totalBudget - totalExpense;

        updateBudget();
    });

    expenseForm.addEventListener("submit", function (event) {
        event.preventDefault();
        const expenseTitle = expenseTitleInput.value.trim();
        const expenseValue = parseFloat(expenseValueInput.value);

        // Validate inputs
        if (expenseTitle === "" || expenseValue < 0) { // Fixed the syntax error here
            $(".expense-feedback").text("Value cannot be empty or negative").show();
            return;
        }

        totalExpense += expenseValue;
        balance = totalBudget - totalExpense;

        updateExpenses();
        createExpenseRow(expenseTitle, expenseValue);
    });

    function updateBudget() {
        budgetAmount.textContent = totalBudget.toFixed(2);
        balanceAmount.textContent = balance.toFixed(2);
        budgetFeedback.textContent = "";
    }

    function updateExpenses() {
        expenseAmount.textContent = totalExpense.toFixed(2);
        balanceAmount.textContent = balance.toFixed(2);
        expenseFeedback.textContent = "";
    }

    function createExpenseRow(title, value) {
        const row = expenseTable.insertRow(-1);
        const cellTitle = row.insertCell(0);
        const cellValue = row.insertCell(1);
        const cellActions = row.insertCell(2);

        cellTitle.textContent = title;
        cellValue.textContent = value.toFixed(2);

        const editButton = document.createElement("button");
        editButton.textContent = "Edit";
        editButton.addEventListener("click", function () {
            // pishi
            expenseTitleInput.value = title;
            expenseValueInput.value = value;
            expenseTable.deleteRow(row.rowIndex);
            totalExpense -= value;
            balance = totalBudget - totalExpense;
            updateExpenses();
        });

        const deleteButton = document.createElement("button");
        deleteButton.textContent = "Delete";
        deleteButton.addEventListener("click", function () {
            // brishi
            expenseTable.deleteRow(row.rowIndex);
            totalExpense -= value;
            balance = totalBudget - totalExpense;
            updateExpenses();
        });

        cellActions.appendChild(editButton);
        cellActions.appendChild(deleteButton);
    }
});
