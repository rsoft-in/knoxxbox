<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <div style="padding: 25px;">
        <button onclick="minusCashBack();">Test</button>
    </div>

    <script>
        var api_key = '51f495-5cad79-492ed4-552bcd-79e2ba';
        function getCustomer() {
            var postdata = {
                'bid': api_key,
                'sort': 'customer_name',
                'pn': 0,
                'ps': 30
            };
            postdata = JSON.stringify(postdata);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>/customers/get",
                data: "postdata=" + postdata,
                success: function(result) {
                    console.log(result);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }

        function addCustomer() {
            var postdata = {
                'bid': api_key,
                'name': 'sindhu m',
                'mobile': '7032055707',
                'email': '',
                'address': 'kodungallur'
            };
            postdata = JSON.stringify(postdata);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>/customers/addCustomer",
                data: "postdata=" + postdata,
                success: function(result) {
                    console.log(result);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }

        function addPoints() {
            var postdata = {
                'bid': api_key,
                'mobile': '7032055707',
                'points': 3
            };
            postdata = JSON.stringify(postdata);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>/customers/addPoints",
                data: "postdata=" + postdata,
                success: function(result) {
                    console.log(result);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }

        function minusPoints() {
            var postdata = {
                'bid': api_key,
                'mobile': '7032055707',
                'points': 5
            };
            postdata = JSON.stringify(postdata);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>/customers/deductPoints",
                data: "postdata=" + postdata,
                success: function(result) {
                    console.log(result);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }

        function addCashBack() {
            var postdata = {
                'bid': api_key,
                'mobile': '7032055707',
                'cashback': 50
            };
            postdata = JSON.stringify(postdata);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>/customers/addCashBack",
                data: "postdata=" + postdata,
                success: function(result) {
                    console.log(result);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }

        function minusCashBack() {
            var postdata = {
                'bid': api_key,
                'mobile': '7032055707',
                'cashback': 30
            };
            postdata = JSON.stringify(postdata);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>/customers/deductCashBack",
                data: "postdata=" + postdata,
                success: function(result) {
                    console.log(result);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }
    </script>
</body>

</html>