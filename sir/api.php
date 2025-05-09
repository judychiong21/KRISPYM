<?php
// 1. Database Connection
$host = "localhost"; // Or your specific host
$username = "root";  // Your MySQL username
$password = "";      // Your MySQL password
$database = "delivery";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Handle Incoming Requests (Example:  Process Order)
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_GET["action"] == "process_order") {
    // Get data from the POST request
    $orderData = json_decode(file_get_contents("php://input"), true);

    // Basic validation (ALWAYS do thorough validation!)
    if (empty($orderData['firstName']) || empty($orderData['lastName']) || empty($orderData['email']) || empty($orderData['address']) || empty($orderData['paymentMethod'])) {
        http_response_code(400); // Bad Request
        echo json_encode(array("message" => "Missing required fields."));
        exit;
    }

    // Begin a transaction (for data integrity)
    $conn->begin_transaction();

    try {
        // 3. Insert into customers table
        $firstName = $conn->real_escape_string($orderData['firstName']);
        $lastName = $conn->real_escape_string($orderData['lastName']);
        $email = $conn->real_escape_string($orderData['email']);
        $phone = $conn->real_escape_string($orderData['phone']);
        $address = $conn->real_escape_string($orderData['address']);
        $city = $conn->real_escape_string($orderData['city']);
        $province = $conn->real_escape_string($orderData['province']);
        $postalCode = $conn->real_escape_string($orderData['postalCode']);

        $sql = "INSERT INTO customers (first_name, last_name, email, phone_number, shipping_address, city, province_state, postal_zip_code)
                VALUES ('$firstName', '$lastName', '$email', '$phone', '$address', '$city', '$province', '$postalCode')";
        if ($conn->query($sql) !== TRUE) {
            throw new Exception("Error inserting customer: " . $conn->error);
        }
        $customerId = $conn->insert_id; // Get the new customer ID

      // 4. Insert into orders table
        $paymentMethod = $conn->real_escape_string($orderData['paymentMethod']);
        $gcashMobile = $conn->real_escape_string($orderData['gcashMobile']);
        $codFee = ($paymentMethod == 'cod') ? 20.00 : 0.00; //hardcoded value

        // Calculate total amount (you'll need to get this from the order details)
        $totalAmount = 0;
        foreach ($orderData['items'] as $item) {
          $totalAmount += $item['price'] * $item['quantity'];
        }
        $totalAmount += $codFee;

        $sql = "INSERT INTO orders (customer_id, total_amount, payment_method, gcash_mobile_number, cod_fee, shipping_address, city, province_state, postal_zip_code)
                VALUES ($customerId, $totalAmount, '$paymentMethod', '$gcashMobile', $codFee, '$address', '$city', '$province', '$postalCode')";

        if ($conn->query($sql) !== TRUE) {
             throw new Exception("Error inserting order: " . $conn->error);
        }
        $orderId = $conn->insert_id;

        // 5. Insert into order_items table
        foreach ($orderData['items'] as $item) {
            $itemId = intval($item['item_id']); // Ensure it's an integer
            $quantity = intval($item['quantity']);
            $itemPrice = floatval($item['price']); // Ensure it's a float

            $sql = "INSERT INTO order_items (order_id, item_id, quantity, item_price)
                    VALUES ($orderId, $itemId, $quantity, $itemPrice)";
            if ($conn->query($sql) !== TRUE) {
                 throw new Exception("Error inserting order item: " . $conn->error);
            }
        }

        // 6. Commit the transaction
        $conn->commit();

        // 7. Send a success response
        http_response_code(200); // OK
        echo json_encode(array("message" => "Order placed successfully!", "orderId" => $orderId));

    } catch (Exception $e) {
        // 8. Rollback the transaction on error
        $conn->rollback();
        http_response_code(500); // Internal Server Error
        echo json_encode(array("message" => "Error placing order: " . $e->getMessage()));
    }
}
elseif ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET["action"] == "get_menu") {
    //get menu items from database
     $sql = "SELECT item_id, item_name, price, image_path FROM menu_items";
     $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        $menu = array();
         while($row = $result->fetch_assoc()) {
            $menu[] = $row;
         }
         http_response_code(200);
         echo json_encode($menu);
      }
      else{
        http_response_code(404);
        echo json_encode(array("message" => "No menu items found"));
      }
}

// Close the connection
$conn->close();
?>