<?php 
require_once 'includes/auth_check.php'; 
require_once 'includes/admin_header.php'; 

require_once '../Classes/admin.php';
$admin = new Admin($pdo);

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    if ($admin->deleteProduct($id)) {
        echo "<script>alert('Product deleted successfully!'); window.location='admin_product.php';</script>";
    } else {
        echo "<script>alert('Failed to delete product.');</script>";
    }
}

$products = $admin->getAllProducts();
?>

<h1 class="text-3xl font-bold text-purple-700 mb-6">Manage Products</h1>

<div class="flex justify-between items-center mb-6">
    <p class="text-gray-600">Total Products: <strong><?= count($products) ?></strong></p>
    <a href="admin_product_add.php" 
       class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg font-medium flex items-center gap-2">
        <i class="fas fa-plus"></i> Add New Product
    </a>
</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-purple-700 text-white">
            <tr>
                <th class="p-4 text-left">ID</th>
                <th class="p-4 text-left">Product Name</th>
                <th class="p-4 text-left">Category</th>
                <th class="p-4 text-left">Price</th>
                <th class="p-4 text-left">Stock Status</th>
                <th class="p-4 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <?php foreach($products as $product): 
                $instock = $product['instock'] > 0;
            ?>
            <tr class="hover:bg-gray-50">
                <td class="p-4"><?= $product['id'] ?></td>
                <td class="p-4 font-medium"><?= htmlspecialchars($product['product_name']) ?></td>
                <td class="p-4"><?= htmlspecialchars($product['product_category'] ?? 'N/A') ?></td>
                <td class="p-4 font-semibold">₦<?= number_format((float)$product['product_price']) ?></td>
                <td class="p-4">
                    <span class="px-4 py-1 rounded-full text-sm font-medium
                        <?= $instock ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                        <?= $instock ? 'In Stock' : 'Out of Stock' ?>
                    </span>
                </td>
                <td class="p-4 text-center">
                    <a href="#" class="text-blue-600 hover:underline mx-2">Edit</a>
                    <a href="?delete=<?= $product['id'] ?>" 
                       onclick="return confirm('Are you sure you want to delete this product?')" 
                       class="text-red-600 hover:underline mx-2">
                       Delete
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php if(empty($products)): ?>
    <p class="text-center text-gray-500 py-10">No products found.</p>
<?php endif; ?>

<?php require_once 'includes/admin_footer.php'; ?>