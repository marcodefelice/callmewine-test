<!DOCTYPE html>
<html>
<head>
    <title>Daily Crypto Report</title>
</head>
<body>
    <h1>Top 20 Cryptocurrencies by Volume</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Position</th>
                <th>Name</th>
                <th>Volume</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cryptos as $index => $crypto)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $crypto['name'] }}</td>
                    <td>{{ $crypto['quote']['USD']['volume_24h'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
