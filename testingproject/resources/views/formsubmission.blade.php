<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Send Message</title>
</head>
<body>

    <h1>Please Enter Numbers with comma(',')</h1>
    <form action="{{Route('callsmspostApi')}}" method="post">
        @csrf
        <label>Message</label>
        <input name="message" type="text"><br>
        <label>Mobile numbers</label>
        <input name="mobile_no" type="text"><br><br>
        <input type="submit" value="Submit"><br>
    </form>

</body>
</html>
