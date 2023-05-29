<!doctype html>
<html lang="en">

<head>
    <title>Receipt</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body style="margin-top: 22px;">
    <div class="heading">
        <h4 style="TEXT-ALIGN: center; color:#113835;">Payment Receipt</h4>
        <h5 style="TEXT-ALIGN: center; color:#113835;">Rajasthan Relief Fund Payment Portal(RRFPP)</h5>
    </div>

    <div class="container"
        style="width: 75%;border-radius: 10px;height: auto;box-shadow:5px 5px 10px 10px rgb(0 0 0 / 10%); ">

        <table class="table table-bordered">
            <thead>
                {{-- @foreach ($users as $user) --}}
                <tr>
                    <th scope="col">PRN</th>
                    <td>{{ $user->PRN }}</td>
                </tr>
                <tr>
                    <th scope="col">Currency</th>
                    <td>{{ $user->CURRENCY }}</td>
                </tr>

                <tr>
                    <th scope="col">RPP Txn Id</th>
                    <td>{{ $user->RPPTXNID }}</td>
                </tr>

                {{-- <tr>
                    <th scope="col">Mobile No</th>
                    <td> {{ $user->Mobile_No }} </td>
                </tr> --}}
                <tr>
                    <th scope="col">Payment Mode</th>
                    <td>{{ $user->PAYMENTMODE }} </td>
                </tr>
                <tr>
                    <th scope="col">RPP Timestamp</th>
                    <td>{{ $user->RPPTIMESTAMP }}</td>
                </tr>
                <tr>
                    <th scope="col">Payment Amount</th>
                    <td>{{ $user->PAYMENTAMOUNT }} </td>
                </tr>
                <tr>
                    <th scope="col">Pyment Mode Bid</th>
                    <td>{{ $user->PAYMENTMODEBID }} </td>
                </tr>
                <tr>
                    <th scope="col">Transaction Status</th>
                    <td>{{ $user->RESPONSEMESSAGE }} </td>
                </tr>
                {{-- @endforeach --}}
            </thead>

        </table>

        <footer>
            <div class="span" style="display: flex;justify-content: space-between;">
                <span>Designed and Maintained by RISL</span>

                <span>Copyrights © Dept of IT&C, Govt of Rajasthan. All Rights Reserved.</span>

            </div>
        </footer>
    </div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
