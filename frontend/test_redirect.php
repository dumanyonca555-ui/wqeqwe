<?php
// Simple test file to check redirect functionality
?>
<!DOCTYPE html>
<html>
<head>
    <title>Redirect Test</title>
</head>
<body>
    <h1>Redirect Test</h1>
    <button onclick="testRedirect(1)">Test Chapter 1</button>
    <button onclick="testRedirect(2)">Test Chapter 2</button>
    
    <script>
        function testRedirect(chapterId) {
            console.log("Redirecting to chapter:", chapterId);
            window.location.href = './chapter-play.php?chapter=' + chapterId;
        }
    </script>
</body>
</html>