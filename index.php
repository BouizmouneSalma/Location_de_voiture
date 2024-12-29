<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ./views/signup.php'); 
    exit;
}
require_once './config/databasecnx.php';
require_once './Classes/Voiture.php';
require_once './Classes/Contrat.php';


$db = new DatabaseConnection();
$mysqli = $db->getConnection();
$contra = new Contrat($mysqli);
$voiture = new Voiture($mysqli);
$voitures = $voiture->getAllCars();
// display data 
$contrat = $contra->getAllContrats();
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
<body style=" scroll-behavior: smooth;">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed z-50 w-full">
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
    <div id="carsPage" class="page active max-w-7xl mx-auto p-6  " style="transform: translateY(100px);">
    <?php if (empty($voitures)){?>
        <div class="flex flex-col items-center justify-center p-8 text-center">
                    <div class="animate-bounce">
                        <i data-feather="car" class="w-16 h-16 text-red-500"></i>
                    </div>
                    <h2 class="mt-4 text-2xl font-bold text-gray-800">
                        No Cars Available
                    </h2>
                    <p class="mt-2 text-gray-600">
                        There are currently no cars in the inventory.
                        Please check back later.
                    </p>
                <!-- </div> -->
    <?php } else { ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach($voitures as $voit){
           
           
            ?>
        
                    
            <!-- Available Car Card -->
            <div class="card rounded-2xl shadow-lg overflow-hidden">
                <div class="relative">
                    <img src="<?php echo $voit['Image'] ?>" alt="Car" class="w-full h-56 object-cover">
                    <?php if( $voit['status'] === 'Confirm') {
                       $voit['avaliable'] === 'Reserved';
                     ?>
                         <span class="reserved-badge absolute top-4 right-4 bg-gradient-to-r from-orange-400 to-orange-600 text-white px-4 py-1.5 rounded-full font-semibold shadow-lg">
                         Reserved
                    </span>
                    <?php }else{?>
                    <span class="absolute top-4 right-4 bg-gradient-to-r from-green-400 to-green-600 text-white px-4 py-1.5 rounded-full font-semibold shadow-lg">
                    <?php echo $voit['avaliable'] ?>
                    </span>
                    <?php }?>

                </div>
                <div class="p-6 space-y-4">
                    <h3 class="font-bold text-2xl text-gray-800"><?php echo $voit['Modele'] ?></h3>
                    <div class="flex items-center gap-6 text-gray-600">
                        <span class="flex items-center"><i class="fa-solid fa-car-side mr-2"></i><?php echo $voit['NumImmatriculation']; ?></span>
                        <span class="flex items-center"><i class="fa-solid fa-gauge mr-2"></i><?php echo $voit['Annee'] ?></span>
                    </div>
                    <?php if($voit['status'] === 'Confirm') {?>

                        <div class="text-orange-500 text-center font-medium bg-orange-50 p-3 rounded-lg">
                        <i class="fa-solid fa-clock-rotate-left mr-2"></i>
                        Reserved until <?php echo $voit['DateFin'] ?>
                    </div>
                    <?php }else{?>

                    <form method="post" action="./controllers/Resirvation.php">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="relative mb-3">
                            <i class="fa-regular fa-calendar absolute left-3 top-3 text-blue-600"></i>
                            <input type="date" name="datestart" class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-300 focus:outline-none">
                        </div>
                        <div class="relative mb-3">
                            <i class="fa-regular fa-calendar-check absolute left-3 top-3 text-blue-600"></i>
                            <input type="date" name="dataefin" class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-300 focus:outline-none">
                        </div>
                    </div>
                    
                    <input type="hidden" name="NumImmatriculation" value="<?php echo $voit['NumImmatriculation']; ?>">
                             <?php if( isset($voit['status'])) {?>
                     <?php if($_SESSION['user']['NumClient'] == $voit['NumClient']) {?>
                            
                   <div  name="deleteres" class="text-yellow-500 hover:text-red-600 font-medium transition-colors flex items-center">       
                        Check your Reservation Page
                    </div>
               <?php }else{?>
                    <button type="submit" name="reserve" class="reserve-btn w-full bg-gradient-to-r from-blue-600 to-blue-800 text-white py-3 rounded-lg hover:from-blue-700 hover:to-blue-900 transition-all duration-300 font-semibold shadow-md">
                        Reserve Now
                    </button>
                 
              
                    <?php }?>
               <?php }else{?>

                    <button type="submit" name="reserve" class="reserve-btn w-full bg-gradient-to-r from-blue-600 to-blue-800 text-white py-3 rounded-lg hover:from-blue-700 hover:to-blue-900 transition-all duration-300 font-semibold shadow-md">
                        Reserve Now
                    </button>
                    <?php } ?>
                    </form>
                  
                  <?php } ?>
                </div>
            </div>
        <?php }?>
            
        <?php }?>
        </div>
    </div>
    

    <!-- Reservations Page -->
    <div id="reservationsPage" class="page max-w-7xl mx-auto p-6">
        <h2 class="text-3xl font-bold mb-8 text-gray-800">My Reservations</h2>
        <?php if (empty($contrat)){?>
        <div class="flex flex-col items-center justify-center p-8 text-center">
                    <div class="animate-bounce">
                        <i data-feather="car" class="w-16 h-16 text-red-500"></i>
                    </div>
                    <h2 class="mt-4 text-2xl font-bold text-gray-800">
                        No Cars Reserved
                    </h2>
                    <p class="mt-2 text-gray-600">
                        Chose Cars to reserved 
                    </p>
                <!-- </div> -->
    <?php } else { ?>
        <?php foreach($contrat as $cont){?>
            <?php if($_SESSION['user']['NumClient'] == $cont['NumClient']) {?>
          
        <div class="space-y-6  mb-5" style="transform:translateY(50px);">
            <!-- Pending Reservation -->
            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-6">
                        <img src="<?php echo $cont['image']?>" alt="Car" class="rounded-xl shadow-md max-w[150px] max-h-[150px]">
                        <div class="space-y-2">
                            <h3 class="font-bold text-xl text-gray-800"><?php echo $cont['Modele']?></h3>
                            <p class="text-gray-600 flex items-center"><i class="fa-solid fa-car-side mr-2"></i><?php echo $cont['NumImmatriculation']?></p>
                            <div class="text-gray-500 flex items-center">
                                <i class="fa-regular fa-calendar mr-2"></i>
                                <?php echo $cont['DateDebut']?> - <?php echo $cont['DateFin']?>
                            </div>
                        <div class="text-gray-500 flex items-center"><i class="fa-regular fa-calendar-days mr-2"></i><?php echo $cont['Duree']?> Days</div> 

                        </div>
                    </div>

                    <div class="flex flex-col items-end space-y-4">
                        <?php if($cont['status'] === 'Confirm') {?>
                        <span class="reserved-badge bg-gradient-to-r from-green-400 to-green-500 text-white px-4 py-1.5 rounded-full font-semibold shadow-md">
                        Confirmed <i class="fa-solid fa-check"></i>
                        </span>
                        <?php }else
                             if($cont['status'] === 'Annulle') {?>
                            <span class="reserved-badge bg-gradient-to-r from-red-400 to-red-500 text-white px-4 py-1.5 rounded-full font-semibold shadow-md">
                              Canceled <i class="fa-solid fa-ban"></i>
                        </span>
                        <?php }else{?>
                            <span class="reserved-badge bg-gradient-to-r from-yellow-400 to-yellow-500 text-white px-4 py-1.5 rounded-full font-semibold shadow-md">
                        Pending <i class="fa-solid fa-spinner"></i>
                        </span>
                        <form method="post" action="./controllers/Resirvation.php?idcontrat=<?php echo $cont['NumContrat']?>">
                        <button type="submit" name="deleteres" class="text-red-500 hover:text-red-600 font-medium transition-colors flex items-center">
                            <i class="fa-solid fa-times mr-2"></i>
                            Cancel Reservation
                        </button>
                        </form>
                        <?php } ?>
                       
                        
                      
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>

        <?php }?>
        <?php }?>
        <?php }?>
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