<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate - QuizMaster</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&family=Montserrat:wght@400;500;600;700&family=Great+Vibes&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #e9ecef;
            display: flex; justify-content: center; align-items: center;
            min-height: 100vh; padding: 20px;
        }

        .cert-container {
            width: 1100px; height: 780px;
            background-color: #ffffff;
            position: relative; overflow: hidden;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .bg-svg {
            position: absolute; top: 0; left: 0;
            width: 100%; height: 100%; z-index: 1;
        }

        .cert-border {
            position: absolute; top: 25px; bottom: 25px; left: 25px; right: 25px;
            border: 2px solid #ce9c3a; z-index: 4; pointer-events: none;
        }

        .right-ribbon {
            position: absolute; top: 0; right: 140px;
            width: 90px; height: 400px;
            background-color: #0e1e3b;
            clip-path: polygon(0 0, 100% 0, 100% 100%, 50% 88%, 0 100%);
            z-index: 5;
        }

        .gold-seal {
            position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%);
            width: 130px; height: 130px;
            display: flex; justify-content: center; align-items: center;
            filter: drop-shadow(0 10px 15px rgba(0,0,0,0.4)); z-index: 6;
        }

        .gold-seal img {
            width: 100%;
            height: auto;
            display: block;
        }

        .content {
            position: absolute; top: 160px; left: 0; width: 100%;
            text-align: center; z-index: 15; padding: 0 40px;
        }

        .title { font-family: 'Playfair Display', serif; font-size: 60px; color: #0e1e3b; letter-spacing: 2px; margin-bottom: 25px; font-weight: 700; }
        .subtitle {
            font-size: 16px; color: #ce9c3a; font-weight: 700; letter-spacing: 3px;
            display: flex; align-items: center; justify-content: center; margin-bottom: 60px; text-transform: uppercase;
        }
        .subtitle::before, .subtitle::after { content: ''; width: 90px; height: 1px; background-color: #ce9c3a; margin: 0 15px; }
        
        .presented { font-size: 13px; color: #0e1e3b; letter-spacing: 1.5px; margin-bottom: 30px; font-weight: 500; text-transform: uppercase; }
        .recipient { font-family: 'Playfair Display', serif; font-size: 56px; color: #0e1e3b; margin-bottom: 10px; line-height: 1; font-style: italic; }
        .name-divider { width: 45%; height: 0; border-bottom: 1px dotted #888; margin: 0 auto 40px; }
        
        .lorem-gold { font-size: 13px; color: #ce9c3a; font-weight: 600; letter-spacing: 1px; margin-bottom: 15px; text-transform: uppercase; }
        .lorem-desc { font-size: 14px; color: #0e1e3b; line-height: 1.6; max-width: 55%; margin: 0 auto; }

        .footer { display: flex; justify-content: space-between; width: 55%; margin: 70px auto 0; }
        .sig-box { width: 160px; text-align: center; }
        .sig-date { font-size: 16px; color: #0e1e3b; margin-bottom: 5px; min-height: 24px; font-weight: 500; }
        .sig-line { width: 100%; height: 1px; background-color: #888; margin-bottom: 8px; }
        .sig-label { font-size: 12px; color: #0e1e3b; font-weight: 600; text-transform: capitalize; }

        @media (max-width: 1150px) { .cert-container { transform: scale(0.85); } }
        @media (max-width: 950px) { .cert-container { transform: scale(0.7); } }
        @media (max-width: 750px) { .cert-container { transform: scale(0.5); } }
    </style>
</head>
<body>

<div class="cert-container">
    <svg class="bg-svg" preserveAspectRatio="none" viewBox="0 0 1100 780">
        <!-- Gray Sweeps -->
        <path d="M0,0 L350,0 C200,300 150,550 0,780 Z" fill="#f4f5f7" />
        <path d="M1100,0 L850,0 C1000,300 1050,550 1100,780 Z" fill="#f4f5f7" opacity="0.5" />
        
        <!-- Bottom Gold and Navy Sweeps -->
        <path d="M0,450 C300,620 700,680 1100,500 L1100,800 L0,800 Z" fill="#ce9c3a" />
        <path d="M0,480 C300,660 750,720 1100,540 L1100,800 L0,800 Z" fill="#0e1e3b" />
        
        <!-- Small Navy accent bottom right -->
        <path d="M700,800 C850,790 1000,760 1100,740 L1100,800 Z" fill="#0e1e3b" />
    </svg>
    <div class="cert-border"></div>

    <div class="right-ribbon">
        <div class="gold-seal">
            <img src="assets/images/Achievement Badge.png" alt="Badge" />
        </div>
    </div>

    <div class="content">
        <h1 class="title">CERTIFICATE</h1>
        <div class="subtitle">OF EXCELLENCE</div>
        <div class="presented">THIS CERTIFICATE IS PROUDLY PRESENTED TO</div>
        <div class="recipient">Name Surname</div>
        <div class="name-divider"></div>
        <div class="lorem-gold">LOREM IPSUM DOLOR SIT AMET, CONSECTETUR</div>
        <div class="lorem-desc">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit,<br>
            eiusmod tempor incididunt ut labore et dolore magna aliqua. Laboris nisi.
        </div>
        <div class="footer">
            <div class="sig-box">
                <div class="sig-date">Date</div><div class="sig-line"></div><div class="sig-label">Date</div>
            </div>
            <div class="sig-box">
                <div class="sig-date" style="font-family: 'Great Vibes', cursive; font-size: 42px; line-height: 0.8; margin-bottom: 2px;">Suraj Manani</div>
                <div class="sig-line"></div><div class="sig-label">Signature</div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
