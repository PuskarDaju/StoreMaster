<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to StoreMaster</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        
        body, html {
            margin: 0; padding: 0;
            height: 100%; overflow: hidden;
            font-family: 'Poppins', sans-serif;
        }

        .hero {
            background: linear-gradient(-45deg, #36b9cc, #4e73df, #1cc88a, #5a5c69);
            background-size: 400% 400%;
            animation: gradientBG 10s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
            color: white;
            text-align: center;
            flex-direction: column;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50% }
            50% { background-position: 100% 50% }
            100% { background-position: 0% 50% }
        }

        .login-button {
            position: absolute;
            top: 20px;
            right: 30px;
            z-index: 2;
        }

        .animated-text {
            opacity: 0;
            font-size: 2rem;
            font-weight: 600;
            animation: fadeIn 1.5s ease-in-out forwards;
        }

        .animated-text.fade-out {
            animation: fadeOut 1s ease-in-out forwards;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeOut {
            0% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(-20px); }
        }

        .start-btn {
            margin-top: 40px;
            padding: 12px 30px;
            font-size: 1.1rem;
            background-color: white;
            color: #4e73df;
            border: none;
            border-radius: 30px;
            transition: all 0.3s ease;
            opacity: 0;
            animation: fadeIn 1.5s ease forwards;
            animation-delay: 6s;
        }

        .start-btn:hover {
            background-color: #f8f9fc;
            transform: scale(1.05);
        }

        .bubbles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .bubbles span {
            position: absolute;
            display: block;
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.15);
            bottom: -30px;
            animation: rise 18s linear infinite;
            border-radius: 50%;
        }

        @keyframes rise {
            0% { transform: translateY(0) scale(0); }
            100% { transform: translateY(-1000px) scale(1); }
        }

        .bubbles span:nth-child(1) { left: 10%; animation-delay: 0s; }
        .bubbles span:nth-child(2) { left: 25%; animation-delay: 2s; }
        .bubbles span:nth-child(3) { left: 40%; animation-delay: 4s; }
        .bubbles span:nth-child(4) { left: 55%; animation-delay: 6s; }
        .bubbles span:nth-child(5) { left: 70%; animation-delay: 8s; }
        .bubbles span:nth-child(6) { left: 85%; animation-delay: 10s; }

        .glowing-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #fff;
    animation: glowPulse 4s ease-in-out infinite;
    text-shadow: 0 0 10px rgba(255,255,255,0.7), 0 0 20px rgba(54,185,204,0.6), 0 0 30px rgba(54,185,204,0.4);
    z-index: 1;
    position: relative;
}

@keyframes glowPulse {
    0% {
        opacity: 0.7;
        text-shadow: 0 0 10px rgba(255,255,255,0.3), 0 0 20px rgba(54,185,204,0.2);
    }
    50% {
        opacity: 1;
        text-shadow: 0 0 20px rgba(255,255,255,0.8), 0 0 30px rgba(54,185,204,0.6), 0 0 40px rgba(54,185,204,0.5);
    }
    100% {
        opacity: 0.7;
        text-shadow: 0 0 10px rgba(255,255,255,0.3), 0 0 20px rgba(54,185,204,0.2);
    }
}

    </style>
</head>
<body>
    <div class="hero">
        <!-- Login -->
        

        <!-- Floating bubbles -->
        <div class="bubbles">
            <span></span><span></span><span></span><span></span><span></span><span></span>
        </div>

        <!-- Texts (animated one by one) -->
        <div id="textContainer" style="z-index: 1;"></div>
       <!-- Glowing Subtitle -->
<h1 class="glowing-title mt-4">StoreMaster – A Complete Solution for Your Store</h1>



        <!-- Button after animation ends -->
        <a href="{{ route('login') }}" class="start-btn">Start Selling Smarter</a>
    </div>

     <script>
    const texts = [
        "Welcome to StoreMaster",
        "Manage your stock in real-time 📦",
        "Track sales and profits 📊",
        "Predict trends with smart analytics 🔮"
    ];

    const container = document.getElementById("textContainer");
    let index = 0;

    function showNextText() {
        const el = document.createElement("div");
        el.classList.add("animated-text");
        el.innerText = texts[index];
        container.innerHTML = "";
        container.appendChild(el);

        // After 2 seconds, fade out and prepare next text
        setTimeout(() => {
            el.classList.add("fade-out");
            setTimeout(() => {
                index = (index + 1) % texts.length; // Loop back to start
                showNextText();
            }, 1000); // wait for fade-out
        }, 2000); // visible for 2 seconds
    }

    window.onload = showNextText;
</script>

</body>
</html>
