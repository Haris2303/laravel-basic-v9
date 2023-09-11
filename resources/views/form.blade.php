<!DOCTYPE html>
<html lang="en">

<head>
    <title>Form Input</title>
</head>

<body>
    <form action="/form" method="post">
        <label for="name">
            <input type="text" name="name">
        </label>
        <input type="submit" value="Input">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
</body>

</html>
