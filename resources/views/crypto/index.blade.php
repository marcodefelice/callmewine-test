<!DOCTYPE html>
<html>
<head>
    <title>Top 100 Cryptocurrencies</title>
</head>
<body>
    <h1>Top 100 Cryptocurrencies by Market Cap</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Position</th>
                <th>Name</th>
                <th>Market Cap</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cryptos as $index => $crypto)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $crypto['name'] }}</td>
                    <td>{{ $crypto['quote']['USD']['market_cap'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
