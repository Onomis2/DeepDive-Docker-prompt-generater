<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <textarea name="" id="prompt">  </textarea>
    <button>send</button>
    <script>
        document.querySelector('button')
            .addEventListener('click', () => {
                const data = new URLSearchParams();
                data.append('prompt', document.getElementById('prompt').value);
                fetch('ai_api.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: data
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data)
                    document.getElementById('prompt').value = data.response
            })
            })
    </script>
</body>
</html>