const contentSection = document.getElementById("content");
const ordersLink = document.getElementById("ordersLink");
const productsLink = document.getElementById("productsLink");
const customersLink = document.getElementById("customersLink");
// ... other navigation links (if applicable)

// Function to display the appropriate content section
function displayContent(sectionName) {
  contentSection.innerHTML = ""; // Clear previous content
  contentSection.classList.remove(
    "active-orders",
    "active-products",
    "active-customers"
  ); // Remove previous active class (optional)

  switch (sectionName) {
    case "orders":
      contentSection.innerHTML = `<h2>Recent Orders</h2>
      <table>
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Total</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
              <tr>
                <td><?= $order->id ?></td>
                <td><?= $order->customer ?></td>
                <td><?= $order->total ?></td>
                <td><?= $order->status ?></td>
              </tr>
            <?php endforeach; ?>
              
        </tbody>
      </table>
      `;
      contentSection.classList.add("active-orders"); // Add active class (optional)
      // Fetch and populate order data here (replace with your comment)
      break;
    case "products":
      contentSection.innerHTML = `<h2>Product List</h2>
      <ul>
      </ul>`;
      contentSection.classList.add("active-products"); // Add active class (optional)
      // Fetch and populate product data here (replace with your comment)
      break;
    // Add similar cases for customers, settings, etc.
    default:
      contentSection.innerHTML = "<h2>Welcome to the Admin Dashboard!</h2>";
  }
}

// Add event listeners for navigation links
ordersLink.addEventListener("click", () => displayContent("orders"));
productsLink.addEventListener("click", () => displayContent("products"));
customersLink.addEventListener("click", () => displayContent("customers"));
// ... similar listeners for other links (if applicable)

// Call populateContent with default content on page load
populateContent();
