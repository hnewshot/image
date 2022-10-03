
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <title>Image Tools</title>
    <!--<link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Faster+One&family=Monoton&family=Nosifer&display=swap" rel="stylesheet">-->
    
<style>
@import url('https://fonts.googleapis.com/css2?family=Faster+One&family=Monoton&family=Nosifer');
/* devanagari */
@font-face {
  font-family: 'Poppins';
  font-style: normal;
  font-weight: 700;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLCz7Z11lFc-K.woff2) format('woff2');
  unicode-range: U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;
}
/* latin-ext */
@font-face {
  font-family: 'Poppins';
  font-style: normal;
  font-weight: 700;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLCz7Z1JlFc-K.woff2) format('woff2');
  unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Poppins';
  font-style: normal;
  font-weight: 700;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLCz7Z1xlFQ.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}

:root {
  --max-width: 500px;
  --max-height: 700px;
}

* {
    margin:0;
    padding:0;
    border: 0;
    text-decoration: none;
    outline: 0;
    box-sizing: border-box;
}

body {
    text-align: center;
    background:#f1f1f1;
}

.ctrl {
    max-width: var(--max-width);
}

#div{
    width: var(--max-width);
    height: var(--max-height);
    overflow: hidden;
    position: relative;
    display:flex;
    flex-direction: column;
    background: #ccc;
}

#image{
    width: var(--max-width);
}

#textBox {
    background: #f7f7f7;
    font-family: 'Poppins', sans-serif;
    font-size: 32px;
    padding: 20px 30px;
    text-align: justify;
}

input[type="file" i] {
    -webkit-appearance: initial;
    cursor: pointer;
    align-items: baseline;
    color: inherit;
    text-align: center!important;
    background: #f1f1f1;
    padding: 13px;
    border-radius: 4px;
    border: 3px solid #ccc;
    display: block;
    margin: 20px auto;
    width: 80%;
}

.myButton {
    flex: 1;
    box-shadow: inset 0px 1px 0px 0px #f9eca0;
    background-color: #FF5722;
    border-radius: 6px;
    display: block;
    cursor: pointer;
    color: #fff;
    font-size: 15px;
    font-weight: bold;
    padding: 12px 0px;
    margin: 20px auto;
    width: 80%;
}

.myButton:hover {
	background-color:#f2ab1e;
}
.myButton:active {
	position:relative;
	top:1px;
}

    </style>
</head>

<body>
    <div class="small">
        <div id="div">
            <div contenteditable="true" id="textBox" onchange="console.log('changed')">दीपावली शॉपिंग से पहले ये गाइड पढ़िए...</div>
            <div id="image"></div>
        </div>
    
        <div class="ctrl">
            <input type="file" id="file"/>
            <button class="myButton" id="button">Download</button>
        </div>
    </div>
            
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
    <script src="https://cdn.jsdelivr.net/g/filesaver.js"></script>
    
<script>
//Image Height Set
const imageHeight = 700;

document.getElementById("textBox").addEventListener("input", function() {
    document.getElementById("image").style.height = imageHeight - document.getElementById('textBox').offsetHeight + "px";
}, false);

$(document).ready(function() {
    $("#button").click(function() {

        domtoimage.toJpeg(document.getElementById('div'), { quality: 1 }).then(function(dataUrl) {
                var link = document.createElement('a');
                var filename = $('input[type=file]').val().split('\\').pop();
                //filename.replace(".jpg", "")
                link.download = filename.split('.')[0] + '.jpg';
                link.href = dataUrl;
                link.click();
            });
    })
});


//img to base64
document.querySelector('#file').addEventListener('change', handleFileSelect, false);

$('input[type=file]').change(function() {
    console.dir(this.files[0])
})

function handleFileSelect(e) {
    var files = e.target.files;
    var filesArr = Array.prototype.slice.call(files);
    filesArr.forEach(function(f) {
        if (!f.type.match("image.*")) return;
        var reader = new FileReader();
        reader.onload = function(e) {
            var base64 = e.target.result;
            document.getElementById("image").style.height = imageHeight - document.getElementById('textBox').offsetHeight + "px";
            document.getElementById("image").style.backgroundImage = `url(${base64})`;
            document.getElementById("image").style.backgroundSize = 'cover';
            document.getElementById("image").style.backgroundPosition = "top";
            document.getElementById("image").style.backgroundRepeat = "no-repeat";
        };
        reader.readAsDataURL(f);
    });
};

   </script>
</body>
</html>