<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Donation Invoice</title>

    <style>
        @media print {

            header,
            footer,
            img,
            a,
            button,
            .print {
                display: none;
            }
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .invoice {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            margin-bottom: 40px;
        }

        .info,
        .details {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .total {
            text-align: right;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            color: #888;
        }

        h2 {
            text-align: center;
            background-color: #d8d8d8;
        }
    </style>
</head>

<body>
    <div class="invoice">
        <button type="button" class="print" onclick="printTable()" style="color: white;
    background-color: #111160;border-color: #111160;font-weight: 700;">Print PDF</button>
        <div class="header">
            <h2>Rajasthan Relief Fund Payment Portal</h2>
            <!-- <h2>RajCOMP Info Services Ltd. (A Govt. of Rajasthan Validated)</h2> -->
            <h3>Payment Receipt</h3>
        </div>
        <div class="content">
            <div class="info">
                <h2>Donor Information</h2>
                <p><strong>Donor Name:</strong> {{ $data->RemitterName }}</p>
                <p><strong>Email:</strong> {{ $data->RemitterEmailId }}</p>
                <p><strong>Phone:</strong> {{ $data->RemitterMobile }}</p>
            </div>
            <div class="details">
                <h2>Transaction Details</h2>
                <table>
                    <tr>
                        <th>RPP Txn Id</th>
                        <td>{{ $data->RPPTxnId }}</td>
                        <th>PRN</th>
                        <td>{{ $data->PRN }}</td>
                    </tr>
                    <tr>
                        <th>Purpose</th>
                        <td>{{ $data->Purpose }}</td>
                        <th>Status</th>
                        <td style="color: green;font-weight: 700;">SUCCESS</td>
                    </tr>
                    <tr>
                        <th>Bank Name</th>
                        <td>{{ $data->PayModeBankName }}</td>
                        <th>Bank BID</th>
                        <td>{{ $data->PayModeBankBID }}</td>
                    </tr>
                    <tr>
                        <th>Amount</th>
                        <td>{{ $data->AMOUNT }}</td>
                        <th>Transaction Date</th>
                        <td>{{ $data->created_at }}</td>
                    </tr>                   
                </table>
            </div>           
            <div class="info">
                <h2>Merchant Details</h2>
                <p><strong>Nodal Officer Name:</strong> Yuvraj Singh</p>
                <p><strong>Nodal Officer Email:</strong> yuvrajsingh.doit@rajasthan.gov.in</p>
                <p><strong>Address:</strong>DOITC, Jaipur, RajasthanPincode:302005</p>
            </div>
        </div>
        <div class="footer">
            <p>Thank you for your generous donation!</p>
        </div>
    </div>

    <script>
        function printTable() {
            window.print();
        }
    </script>
</body>

</html>
