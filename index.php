<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ./views/signup.php'); 
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
        }
        
        .nav-link {
            position: relative;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: #1d4ed8;
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }
        
        .card {
            transition: all 0.3s ease;
            background: linear-gradient(145deg, #ffffff, #f3f4f6);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1);
        }

        .logo-text {
            background: linear-gradient(135deg, #000000 0%, #1e3a8a 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .reserved-badge {
            animation: pulse 2s infinite;
            box-shadow: 0 0 15px rgba(251, 146, 60, 0.5);
        }

        .page {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .page.active {
            display: block;
        }

        @keyframes pulse {
            0% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.05); }
            100% { opacity: 1; transform: scale(1); }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-8 py-6">
            <div class="flex justify-between items-center">
                <!-- Enhanced Logo -->
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-car-side text-4xl bg-gradient-to-r from-black to-blue-900 text-transparent bg-clip-text"></i>
                    <div>
                        <span class="text-3xl font-bold logo-text tracking-wider">Loca</span>
                        <span class="text-3xl font-black logo-text">Auto</span>
                    </div>
                </div>
                
                <!-- Enhanced Navigation -->
                <div class="flex items-center space-x-12">
                    <div class="flex space-x-8">
                        <button id="showCars" class="nav-link active text-lg font-semibold hover:text-blue-800 transition-colors flex items-center">
                            <i class="fa-solid fa-car-rear mr-2"></i>
                            Available Cars
                        </button>
                        <button id="showReservations" class="nav-link text-lg font-semibold hover:text-blue-800 transition-colors flex items-center">
                            <i class="fa-solid fa-clock-rotate-left mr-2"></i>
                            My Reservations
                        </button>
                    </div>
                    
                    <div class="flex items-center space-x-6">
                        <button class="relative">
                            <i class="fa-solid fa-bell text-xl text-gray-600 hover:text-blue-800 transition-colors"></i>
                            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center animate-pulse">3</span>
                        </button>
                        <a href="./controllers/logout.php"><button class="bg-black hover:bg-gray-800 text-white px-6 py-2.5 rounded-full transition-colors duration-300 flex items-center space-x-2">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Logout</span>
                        </button></a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Cars Page -->
    <div id="carsPage" class="page active max-w-7xl mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Available Car Card -->
            <div class="card rounded-2xl shadow-lg overflow-hidden">
                <div class="relative">
                    <img src="https://www.cartecgroup.com/app/uploads/sites/4/2024/06/1719391246VEHICLE-VIEW-030-X5-xDrive50e-1719391167805.png" alt="Car" class="w-full h-56 object-cover">
                    <span class="absolute top-4 right-4 bg-gradient-to-r from-green-400 to-green-600 text-white px-4 py-1.5 rounded-full font-semibold shadow-lg">
                        Available
                    </span>
                </div>
                <div class="p-6 space-y-4">
                    <h3 class="font-bold text-2xl text-gray-800">Mercedes C200</h3>
                    <div class="flex items-center gap-6 text-gray-600">
                        <span class="flex items-center"><i class="fa-solid fa-car-side mr-2"></i>MAT-1234</span>
                        <span class="flex items-center"><i class="fa-solid fa-gauge mr-2"></i>2023</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="relative">
                            <i class="fa-regular fa-calendar absolute left-3 top-3 text-blue-600"></i>
                            <input type="date" class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-300 focus:outline-none">
                        </div>
                        <div class="relative">
                            <i class="fa-regular fa-calendar-check absolute left-3 top-3 text-blue-600"></i>
                            <input type="date" class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-300 focus:outline-none">
                        </div>
                    </div>
                    <button class="reserve-btn w-full bg-gradient-to-r from-blue-600 to-blue-800 text-white py-3 rounded-lg hover:from-blue-700 hover:to-blue-900 transition-all duration-300 font-semibold shadow-md">
                        Reserve Now
                    </button>
                </div>
            </div>

            <!-- Reserved Car Card -->
            <div class="card rounded-2xl shadow-lg overflow-hidden opacity-90">
                <div class="relative">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSykPMU-x81h7S8f35onUHOrDES2cl_4mDW3w&s" alt="Car" class="w-full h-56 object-cover">
                    <span class="reserved-badge absolute top-4 right-4 bg-gradient-to-r from-orange-400 to-orange-600 text-white px-4 py-1.5 rounded-full font-semibold shadow-lg">
                        Reserved
                    </span>
                </div>
                <div class="p-6 space-y-4">
                    <h3 class="font-bold text-2xl text-gray-800">BMW X5</h3>
                    <div class="flex items-center gap-6 text-gray-600">
                        <span class="flex items-center"><i class="fa-solid fa-car-side mr-2"></i>MAT-5678</span>
                        <span class="flex items-center"><i class="fa-solid fa-gauge mr-2"></i>2024</span>
                    </div>
                    <div class="text-orange-500 text-center font-medium bg-orange-50 p-3 rounded-lg">
                        <i class="fa-solid fa-clock-rotate-left mr-2"></i>
                        Reserved until 25/12/2024
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reservations Page -->
    <div id="reservationsPage" class="page max-w-7xl mx-auto p-6">
        <h2 class="text-3xl font-bold mb-8 text-gray-800">My Reservations</h2>
        <div class="space-y-6">
            <!-- Pending Reservation -->
            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-6">
                        <img src="https://www.cartecgroup.com/app/uploads/sites/4/2024/06/1719391246VEHICLE-VIEW-030-X5-xDrive50e-1719391167805.png" alt="Car" class="rounded-xl shadow-md max-w[150px] max-h-[150px]">
                        <div class="space-y-2">
                            <h3 class="font-bold text-xl text-gray-800">Mercedes C200</h3>
                            <p class="text-gray-600 flex items-center"><i class="fa-solid fa-car-side mr-2"></i>MAT-1234</p>
                            <div class="text-gray-500 flex items-center">
                                <i class="fa-regular fa-calendar mr-2"></i>
                                23/12/2024 - 25/12/2024
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col items-end space-y-4">
                        <span class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-white px-4 py-1.5 rounded-full font-semibold shadow-md">
                            Pending
                        </span>
                        <button class="text-red-500 hover:text-red-600 font-medium transition-colors flex items-center">
                            <i class="fa-solid fa-times mr-2"></i>
                            Cancel Reservation
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const showCars = document.getElementById('showCars');
            const showReservations = document.getElementById('showReservations');
            const carsPage = document.getElementById('carsPage');
            const reservationsPage = document.getElementById('reservationsPage');

            function switchPage(show, hide, activeBtn, inactiveBtn) {
                hide.classList.remove('active');
                show.classList.add('active');
                inactiveBtn.classList.remove('active');
                activeBtn.classList.add('active');
            }

            showCars.addEventListener('click', () => {
                switchPage(carsPage, reservationsPage, showCars, showReservations);
            });

            showReservations.addEventListener('click', () => {
                switchPage(reservationsPage, carsPage, showReservations, showCars);
            });

            document.querySelectorAll('.reserve-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const card = btn.closest('.card');
                    const startDate = card.querySelector('input[type="date"]:first-of-type').value;
                    const endDate = card.querySelector('input[type="date"]:last-of-type').value;
                    
                    if (!startDate || !endDate) {
                        alert('Please select both start and end dates');
                        return;
                    }
                    
                    if (new Date(startDate) > new Date(endDate)) {
                        alert('End date must be after start date');
                        return;
                    }
                    
                    // Update UI and switch to reservations
                    const statusBadge = card.querySelector('span');
                    statusBadge.textContent = 'Reserved';
                    statusBadge.classList.remove('from-green-400', 'to-green-600');
                    statusBadge.classList.add('from-orange-400', 'to-orange-600', 'reserved-badge');
                    
                    setTimeout(() => showReservations.click(), 500);
                });
            });
        });
        
        // Empêcher le retour arrière
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.pushState(null, null, location.href);
        };
    </script>
    
</body>
</html>