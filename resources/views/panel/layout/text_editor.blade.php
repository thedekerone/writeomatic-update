<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Text Editor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .editor {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
            width: 80%;
        }
        .toolbar select, .toolbar button {
            margin-right: 10px;
        }
        textarea {
            width: 100%;
            height: 300px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="editor">
        <div class="toolbar">
            <select id="fontFamily" title="Choose font">
                <option value="Arial">Arial</option>
                <option value="Courier New">Courier New</option>
                <option value="Georgia">Georgia</option>
                <option value="Times New Roman">Times New Roman</option>
                <option value="Verdana">Verdana</option>
            </select>
            <select id="fontSize" title="Choose font size">
                <option value="12px">12</option>
                <option value="14px">14</option>
                <option value="16px">16</option>
                <option value="18px">18</option>
                <option value="20px">20</option>
            </select>
            <button id="boldBtn" title="Bold">B</button>
            <button id="italicBtn" title="Italic">I</button>
            <input type="color" id="fontColor" title="Choose font color">
        </div>
        <textarea id="editorArea"></textarea>
    </div>

    <script>
        document.getElementById('fontFamily').addEventListener('change', function() {
            document.getElementById('editorArea').style.fontFamily = this.value;
        });

        document.getElementById('fontSize').addEventListener('change', function() {
            document.getElementById('editorArea').style.fontSize = this.value;
        });

        document.getElementById('boldBtn').addEventListener('click', function() {
            document.getElementById('editorArea').style.fontWeight = 
                document.getElementById('editorArea').style.fontWeight === 'bold' ? 'normal' : 'bold';
        });

        document.getElementById('italicBtn').addEventListener('click', function() {
            document.getElementById('editorArea').style.fontStyle = 
                document.getElementById('editorArea').style.fontStyle === 'italic' ? 'normal' : 'italic';
        });

        document.getElementById('fontColor').addEventListener('input', function() {
            document.getElementById('editorArea').style.color = this.value;
        });
    </script>
</body>
</html>
