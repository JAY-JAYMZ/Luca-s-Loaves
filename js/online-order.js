document.addEventListener("DOMContentLoaded", function () {
    // Display email
    const email = localStorage.getItem("userEmail");
    document.getElementById("user-email").innerText = `Dear ${email}`;

    // Menu Action: Add to order
    document.querySelectorAll(".add-button").forEach(button => {
        button.addEventListener("click", function () {
            const row = this.closest("tr");
            const dish = row.querySelector(".dish").innerText;
            const price = parseFloat(row.querySelector(".price").innerText);
            const ingredient = row.querySelector(".ingredient").innerText;

            addOrder(dish, price, ingredient);
        });
    });
});

// Add an item to the order table
function addOrder(dish, price, ingredient) {
    // Implementation for order table and total price update
}

// Submit order to the server
document.getElementById("submit-order").addEventListener("click", function () {
    // Submit data to PHP script
    fetch("submit_order.php", {
        method: "POST",
        body: JSON.stringify(orderData),
        headers: {
            "Content-Type": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Order submitted successfully!");
                setTimeout(() => window.location.reload(), 1000);
            }
        });
});