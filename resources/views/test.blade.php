<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Test</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="{{ asset('js/jquery-3.1.1.min.js',env('HTTPS_ASSET')) }}"></script>
    </head>
    <body>
    <script>
        $.ajax({
            url: '/api/test',
            success: function(data) {
                console.log(data);
            },
            error: function(data) {
                console.log('--error--');
                console.log(data);
            }
        });
    </script>
    </body>
</html>