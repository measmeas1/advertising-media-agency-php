<?php
  session_start();
  $pdo = require_once __DIR__ . '/../config/db.php';

  if (!isset($_SESSION['user'])) {
      header("Location: login.php");
      exit;
  }

  $product_id = $_GET['id'];

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user = $_SESSION['user'];

    $user_id = $user['id'];
    $name    = $user['name'];
    $email   = $user['email'];

    $phone   = $_POST['phone'];
    $message = $_POST['message'];

    $code = 'BK-' . strtoupper(uniqid());

    $stmt = $pdo->prepare("
        INSERT INTO bookings 
        (product_id, user_id, code, name, email, phone, message)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $product_id,
        $user_id,
        $code,
        $name,
        $email,
        $phone,
        $message
    ]);

    $_SESSION['success'] = "✅ Booking confirmed. We’ll contact you soon! Your booking code is <strong>$code</strong>.";
    header("Location: index.php");
    exit;
  }

  $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
  $stmt->execute([$product_id]);
  $product = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking</title>
  <link rel="icon" type="image/png" href="../assets/images/logo.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

  <div class="max-w-3xl mx-auto px-6 py-10">

    <a href="index.php" class="text-sm text-gray-500 hover:text-black mb-6 inline-block">
      ← Back to Services
    </a>

    <div class="bg-white p-8 rounded-xl shadow-lg">

      <h2 class="text-2xl font-bold mb-2">Book Advertisement</h2>
      <p class="text-gray-500 mb-6">
        You are booking: <span class="font-semibold"><?= $product['title'] ?></span>
      </p>

      <?php if (isset($success)): ?>
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
          <?= $success ?>
        </div>
      <?php endif; ?>

      <form id="bookingForm" method="POST" class="space-y-4">
        <input name="phone" required placeholder="Phone Number"
               class="w-full border px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-black">

        <textarea name="message" placeholder="Message (optional)" rows="4"
                  class="w-full border px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-black"></textarea>

        <button type="button" onclick="validateAndOpenModal()"
                class="w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800 transition">
          Confirm Booking
        </button>

      </form>

    </div>
  </div>

  <!-- Confirm Modal -->
  <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white rounded-xl p-6 w-full max-w-md">
      <h3 class="text-xl font-bold mb-2">Confirm Booking</h3>
      <p class="text-gray-600 mb-6">
        Are you sure you want to book this service?
      </p>

      <div class="flex justify-end gap-3">
        <button onclick="closeModal()"
                class="px-4 py-2 border rounded-lg">
          Cancel
        </button>

        <!-- REAL submit button -->
        <button onclick="submitForm()"
                class="px-4 py-2 bg-black text-white rounded-lg">
          Yes, Confirm
        </button>
      </div>
    </div>
  </div>

  <script>
   const form = document.getElementById('bookingForm')

   function validateAndOpenModal() {
     if (!form.checkValidity()) {
       form.reportValidity()
       return
     }

     openModal()
   }

   function openModal() {
     document.getElementById('confirmModal').classList.remove('hidden')
     document.getElementById('confirmModal').classList.add('flex')
   }

   function closeModal() {
     document.getElementById('confirmModal').classList.add('hidden')
     document.getElementById('confirmModal').classList.remove('flex')
   }

   function submitForm() {
     form.submit()
   }
  </script>



</body>
</html>
