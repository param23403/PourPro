<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spend Analysis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="css/common.css">
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
    <?php include __DIR__ . '/components/customer_navbar.php'; ?>
    <?php $spend=$_SESSION["spend"];?>
    <?php if (isset($_SESSION["spend"]) && !empty($_SESSION["spend"])) { ?>
        <div class="orders-list">
            <table>
                <thead>
                    <tr>
                        <th>Purchase Date</th>
                        <th>Total Units ordered</th>
                        <th>Total Money Spent</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($spend as $i) { ?>
                        <tr>
                            <td>
                                <?php echo $i["sales_date"] ?>
                            </td>
                            <td>
                                <?php echo $i["quantity_bought"] ?>
                            </td>
                            <td>
                                <?php echo $i["total_amount"] ?>
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
        <?php include __DIR__ . '/components/customer_footer.php'; ?>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>