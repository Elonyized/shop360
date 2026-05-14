<?php 
require_once 'includes/auth_check.php'; 
require_once 'includes/admin_header.php'; 
?>

<h1 class="text-3xl font-bold text-purple-700 mb-6">Customers</h1>

<div class="bg-white rounded-2xl shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-purple-700 text-white">
            <tr>
                <th class="p-4 text-left">Customer ID</th>
                <th class="p-4 text-left">Account ID</th>
                <th class="p-4 text-left">Full Name</th>
                <th class="p-4 text-left">Phone</th>
                <th class="p-4 text-left">City</th>
                <th class="p-4 text-left">State</th>
                <th class="p-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $pdo->query("SELECT * FROM customers ORDER BY id DESC");
            while($customer = $stmt->fetch()):
            ?>
            <tr class="border-b hover:bg-gray-50">
                <td class="p-4"><?= $customer['id'] ?></td>
                <td class="p-4"><?= $customer['account_Id'] ?></td>
                <td class="p-4 font-medium">
                    <?= htmlspecialchars($customer['first name'] ?? '') . ' ' . htmlspecialchars($customer['last name'] ?? '') ?>
                </td>
                <td class="p-4"><?= htmlspecialchars($customer['phone'] ?? 'N/A') ?></td>
                <td class="p-4"><?= htmlspecialchars($customer['city'] ?? 'N/A') ?></td>
                <td class="p-4"><?= htmlspecialchars($customer['state'] ?? 'N/A') ?></td>
                <td class="p-4">
                    <a href="#" class="text-blue-600 hover:underline">View Orders</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php require_once 'includes/admin_footer.php'; ?>