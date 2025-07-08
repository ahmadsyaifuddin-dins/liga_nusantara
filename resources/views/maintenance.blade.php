<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Sedang Maintenance - Tournament Break</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'float': 'float 20s infinite linear',
                        'pulse-slow': 'pulse 2s infinite',
                        'slide-up': 'slideUp 0.8s ease-out',
                        'dot-pulse': 'dotPulse 1.5s infinite ease-in-out',
                    },
                    keyframes: {
                        float: {
                            '0%': { transform: 'translateX(-50%) translateY(-50%)' },
                            '100%': { transform: 'translateX(-60%) translateY(-60%)' }
                        },
                        slideUp: {
                            'from': { opacity: '0', transform: 'translateY(50px)' },
                            'to': { opacity: '1', transform: 'translateY(0)' }
                        },
                        dotPulse: {
                            '0%, 80%, 100%': { transform: 'scale(0)', opacity: '0.5' },
                            '40%': { transform: 'scale(1)', opacity: '1' }
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill-opacity='0.1'%3E%3Cpolygon fill='%23ffffff' points='50 0 60 40 100 50 60 60 50 100 40 60 0 50 40 40'/%3E%3C/g%3E%3C/svg%3E");
        }
        .dot:nth-child(1) { animation-delay: -0.3s; }
        .dot:nth-child(2) { animation-delay: -0.1s; }
        .dot:nth-child(3) { animation-delay: 0.1s; }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-500 via-purple-600 to-indigo-700 flex items-center justify-center overflow-hidden relative">
    
    <!-- Animated Background -->
    <div class="absolute inset-0 bg-pattern animate-float opacity-20"></div>
    
    <!-- Main Container -->
    <div class="bg-white/95 backdrop-blur-xl rounded-3xl p-8 shadow-2xl text-center max-w-lg w-full mx-4 relative animate-slide-up dark:bg-gray-900/95">
        
        <!-- Maintenance Icon -->
        <div class="text-6xl text-red-500 mb-6 animate-pulse-slow drop-shadow-lg">
            <i class="fas fa-tools"></i>
        </div>
        
        <!-- Title -->
        <h1 class="text-4xl font-bold mb-4 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
            Website Sedang Dimatikan
        </h1>
        
        <!-- Subtitle -->
        <p class="text-xl text-gray-600 dark:text-gray-300 mb-4 font-medium">
            Turnamen sedang dalam masa break
        </p>
        
        <!-- Description -->
        <p class="text-gray-500 dark:text-gray-400 mb-8 leading-relaxed">
            Kami sedang melakukan pemeliharaan sistem untuk memberikan pengalaman terbaik. 
            Mohon bersabar ya, akan segera kembali normal!
        </p>

        <!-- Status Card -->
        <div class="bg-gradient-to-r from-pink-400 to-purple-400 rounded-2xl p-6 mb-8 text-white shadow-lg">
            <div class="flex items-center justify-center gap-2 text-lg font-semibold mb-2">
                <i class="fas fa-pause-circle"></i>
                Status: Maintenance Mode
            </div>
            <div class="flex items-center justify-center text-sm opacity-90">
                Sistem sedang dimatikan
                <div class="flex gap-1 ml-2">
                    <div class="w-1.5 h-1.5 bg-white rounded-full animate-dot-pulse dot"></div>
                    <div class="w-1.5 h-1.5 bg-white rounded-full animate-dot-pulse dot"></div>
                    <div class="w-1.5 h-1.5 bg-white rounded-full animate-dot-pulse dot"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto refresh setiap 5 menit
        setTimeout(() => {
            location.reload();
        }, 300000);

        // Simulate progress update
        let progress = 65;
        const progressBar = document.querySelector('.bg-gradient-to-r.from-blue-500.to-purple-500');
        const progressText = document.querySelector('.flex.justify-between span:last-child');
        
        setInterval(() => {
            if (progress < 95) {
                progress += Math.random() * 2;
                progressBar.style.width = Math.min(progress, 95) + '%';
                progressText.textContent = Math.floor(Math.min(progress, 95)) + '%';
            }
        }, 30000); // Update setiap 30 detik

        // Update waktu secara real-time
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID');
            console.log('Current time:', timeString);
        }
        setInterval(updateTime, 1000);
    </script>
</body>
</html>