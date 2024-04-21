<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="css/inventory.css">
    <style>
        .orders-list {
            width: 100%;
            margin: 0 auto;
        }

        .orders-list h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .orders-list table {
            width: 100%;
            border-collapse: collapse;
            color: white;
        }

        .orders-list th,
        .orders-list td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            background-color: #333; 
        }

        .orders-list th {
            background-color: #555;
        }

        .orders-list tr:nth-child(even) {
            background-color:  #444;
        }

        .orders-list tr:hover {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <?php include __DIR__ . '/components/admin_navbar.php'; ?>
    <?php $sales=$_SESSION["sales"];?>
    <?php if (isset($_SESSION["sales"]) && !empty($_SESSION["sales"])) { ?>
        <div class="orders-list">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Total Quantity Sold</th>
                        <th>Total Sale amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sales as $sale) { ?>
                        <tr>
                            <td>
                                <?php echo $sale["sales_date"] ?>
                            </td>
                            <td>
                                <?php echo $sale["total_quantity_sold"] ?>
                            </td>
                            <td>
                                <?php echo $sale["total_sales"] ?>
                            </td>
                        </tr>
                    <?php }; ?>
                </tbody>
            </table>
        <?php }; ?>
        <br>
        <br>
        <br>
        <br>
        <?php include __DIR__ . '/components/admin_footer.php'; ?>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>