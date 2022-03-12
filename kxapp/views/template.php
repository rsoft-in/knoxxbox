<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knoxxbox</title>
</head>

<body>


    <script type="module">
        // Import the functions you need from the SDKs you need
        import {
            initializeApp
        } from "https://www.gstatic.com/firebasejs/9.6.8/firebase-app.js";
        import {
            getAnalytics
        } from "https://www.gstatic.com/firebasejs/9.6.8/firebase-analytics.js";
        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries

        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        const firebaseConfig = {
            apiKey: "AIzaSyDTu-QVVKTdSte8pbAKyTUkPN29ITth2Is",
            authDomain: "redam-rsoft.firebaseapp.com",
            projectId: "redam-rsoft",
            storageBucket: "redam-rsoft.appspot.com",
            messagingSenderId: "65874920513",
            appId: "1:65874920513:web:86d96130078d73a774b2c0",
            measurementId: "G-XSX9CV455Z"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const analytics = getAnalytics(app);
    </script>
</body>

</html>