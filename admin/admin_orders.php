<?php 
require_once 'includes/auth_check.php'; 
require_once 'includes/admin_header.php'; 
?>

<h1 class="text-3xl font-bold text-purple-700 mb-6">Manage Orders</h1>

<div class="bg-white rounded-2xl shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-purple-700 text-white">
            <tr>
                <th class="p-4 text-left">Order ID</th>
                <th class="p-4 text-left">Customer ID</th>
                <th class="p-4 text-left">Product ID</th>
                <th class="p-4 text-left">Quantity</th>
                <th class="p-4 text-left">Total Amount</th>
                <th class="p-4 text-left">Status</th>
                <th class="p-4 text-left">Date</th>
                <th class="p-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC");
            while($order = $stmt->fetch()):
            ?>
            <tr class="border-b hover:bg-gray-50">
                <td class="p-4 font-medium">#<?= $order['id'] ?></td>
                <td class="p-4"><?= $order['customer_id'] ?></td>
                <td class="p-4"><?= $order['product_id'] ?></td>
                <td class="p-4"><?= $order['quantity'] ?></td>
                <td class="p-4 font-semibold">₦<?= number_format($order['total_amount']) ?></td>
                <td class="p-4">
                    <span class="px-3 py-1 rounded-full text-sm 
                        <?= $order['status'] == 'pending' || $order['status'] == 'Pending' ? 'bg-yellow-100 text-yellow-700' : '' ?>
                        <?= $order['status'] == 'processing' || $order['status'] == 'Processing' ? 'bg-blue-100 text-blue-700' : '' ?>
                        <?= $order['status'] == 'shipped' || $order['status'] == 'Shipped' ? 'bg-purple-100 text-purple-700' : '' ?>
                        <?= $order['status'] == 'delivered' || $order['status'] == 'Delivered' ? 'bg-green-100 text-green-700' : '' ?>">
                        <?= ucfirst($order['status']) ?>
                    </span>
                </td>
                <td class="p-4 text-sm text-gray-500"><?= $order['created_at'] ?></td>
                <td class="p-4">
                    <form method="POST" class="inline">
                        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                        <select name="status" class="border rounded px-2 py-1 text-sm" onchange="this.form.submit()">
                            <option value="pending" <?= $order['status']=='pending'?'selected':'' ?>>Pending</option>
                            <option value="processing" <?= $order['status']=='processing'?'selected':'' ?>>Processing</option>
                            <option value="shipped" <?= $order['status']=='shipped'?'selected':'' ?>>Shipped</option>
                            <option value="delivered" <?= $order['status']=='delivered'?'selected':'' ?>>Delivered</option>
                        </select>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php
// Handle Status Update
if ($_POST && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['status'];
    
    $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->execute([$new_status, $order_id]);
    
    echo "<script>alert('Order status updated!'); window.location='admin_orders.php';</script>";
}
?>

<?php require_once 'includes/admin_footer.php'; ?>