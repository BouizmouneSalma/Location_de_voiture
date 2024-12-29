<?php
 require_once '.././config/databasecnx.php';
 require_once '.././Classes/Voiture.php';
 $db = new DatabaseConnection();
$mysqli = $db->getConnection();
$voiture = new Voiture($mysqli);
// display data 

$voitures = $voiture->getAllCars();

if(isset($_GET['NumEdit'])){    
    $id = $_GET['NumEdit'];
    $val= $voiture->getCarById($id);
    if(isset($val)) {
        echo "<script>
            console.log(document.getElementById('editform'));
            document.addEventListener('DOMContentLoaded', () => {
                document.getElementById('editform').classList.add('active');
               })
              </script>";
    } 
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="refresh" content="5"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href=".././assets/style.css">
    <script src=".././assets/tailwind.js"></script>
</head>

<body class="">
<!-- Side Bar -->
 <div class=" fixed top-0 left-0  w-[230px] h-[100%] z-50 overflow-hidden sidebar ">
    <a href="" class="logo text-xl font-bold h-[56px] flex items-center text-[#1976D2] z-30 pb-[20px] box-content">
        <i class=" mt-4 text-xxl max-w-[60px] flex justify-center "><i class="fa-solid fa-car-side"></i></i> 
        <div class="logoname ml-2"><span>Loca</span>Auto</div>
    </a>
    <ul class="side-menu w-full mt-12">
            <li class=" h-12 bg-transparent ml-2.5 rounded-l-full p-1"><a href="listClients.php"><i class="fa-solid fa-user-group"></i>Clients</a></li>
            <li class="active h-12 bg-transparent ml-2.5 rounded-l-full p-1"><a href="listCars.php"><i class="fa-solid fa-car"></i>Cars</a></li>
            <li class=" h-12 bg-transparent ml-1.5 rounded-l-full p-1"><a href="listContrat.php"><i class="fa-solid fa-file-contract"></i></i>Contrats</a></li>
            <li class=" h-12 bg-transparent ml-1.5 rounded-l-full p-1"><a href="statistic.php"><i class="fa-solid fa-chart-simple"></i>Statistic</a></li>
    </ul>
    <ul class="side-menu w-full mt-12">
            <li class="h-12 bg-transparent ml-2.5 rounded-l-full p-1">
            <a href=".././controllers/logout.php" class="logout">
                    <i class='bx bx-log-out-circle'></i> Logout
                </a>
            </li>
     </ul>
 </div>
<!-- end sidebar -->
<!-- Content -->
<div class="content ">
    <!-- Navbar -->
    <nav class="flex items-center gap-6 h-14 bg-[#f6f6f9] sticky top-0 left-0 z-50 px-6">
            <i class='bx bx-menu'></i>
            <form action="#" class="max-w-[400px] w-full mr-auto">
                <div class="form-input flex items-center h-[36px]">
                    <input class="flex-grow px-[16px] h-full border-0 bg-[#eee] rounded-l-[36px] outline-none w-full text-[#363949]" type="search" placeholder="Search...">
                    <button class="w-[80px] h-full flex justify-center items-center bg-[#1976D2] text-[#f6f6f9] text-[18px] border-0 outline-none rounded-r-[36px] cursor-pointer" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle block min-w-[50px] h-[25px] bg-grey cursor-pointer relative rounded-full"></label>
            <a href="#" class="notif text-[20px] relative">
                <i class='bx bx-bell'></i>
                <span class="count absolute top-[-6px] right-[-6px] w-[20px] h-[20px] bg-[#D32F2F] text-[#f6f6f6] border-2 border-[#f6f6f9] font-semibold text-[12px] flex items-center justify-center rounded-full ">12</span>
            </a>
            <a href="#" class="profile">
                <img class="w-[36px] h-[36px] object-cover rounded-full" width="36" height="36" src=".././assets/image/1054-1728555216-removebg-preview.png">
            </a>
    </nav>

<!-- end nav -->
 <main class=" mainn w-full p-[36px_24px] max-h-[calc(100vh_-_56px)]" >
 <div  class="header flex items-center justify-between gap-[16px] flex-wrap">
 <div class="left">
     <ul class="breadcrumb flex items-center space-x-[16px]">
        <li class="text-[#363949]" ><a href="listClients.php" >
         Client &npr;
           </a></li>
         /
        <li class="text-[#363949]"><a href="listCars.php"  class="active">Cars &npr;</a></li> /
        <li class="text-[#363949]"><a href="listContrat.php"  >Contrats &npr;</a></li> /
        <li class="text-[#363949]"><a href="statistic.php" >Statistic &npr;</a></li>

     </ul>

</div>
   <a id="buttonadd" href="#" class="report h-[36px] px-[16px] rounded-[36px] bg-[#1976D2] text-[#f6f6f6] flex items-center justify-center gap-[10px] font-medium">
   <i class="fa-solid fa-car"></i>
                    <span>Add Car</span>
    </a>
 </div>
 <!-- insights-->
 <ul class="insights grid grid-cols-[repeat(auto-fit,_minmax(240px,_1fr))] gap-[24px] mt-[36px]">
                <li>
                 <i class="fa-solid fa-user-group"></i>
                    <span class="info">
                        <h3>
                            <?php
                            // echo $result['total_clients'];
                            ?>
                        </h3>
                        <p>Clients</p>
                    </span>
                </li>
                <li><i class="fa-solid fa-car-side"></i>
                    <span class="info">
                        <h3>
                        <?php
                            // echo $resultv['total_voitures'];
                            ?>
                        </h3>
                        <p>Cars</p>
                    </span>
                </li>
                <li><i class="fa-solid fa-file-signature"></i>
                    <span class="info">
                        <h3>
                        <?php
                            // echo $resultc['total_contrats'];
                        ?>
                        </h3>
                        <p>Contrats</p>
                    </span>
                </li>
 </ul>
 <!---- data content ---->
 <div class="bottom-data flex flex-wrap gap-[24px] mt-[24px] w-full ">
 <div class="orders  flex-grow flex-[1_0_500px]">
 <div class="header  flex items-center gap-[16px] mb-[24px]">
        <i class='bx bx-list-check'></i>
        <h3 class="mr-auto text-[24px] font-semibold">List Cars</h3>
        <i class='bx bx-filter'></i>
        <i class='bx bx-search'></i>
</div>
<!--- tables---->
<table  class="w-full border-collapse">
                        <thead>
                            <tr class="">
                                <th class="pb-3 px-3 text-sm text-left border-b border-grey">Registration number</th>
                                <th class="pb-3 px-3 text-sm text-left border-b border-grey">Image</th>
                                <th class="pb-3 px-3 text-sm text-left border-b border-grey">Mark </th>
                                <th class="pb-3 px-3 text-sm text-left border-b border-grey">Model </th>
                                <th class="pb-3 px-3 text-sm text-left border-b border-grey">Year</th>
                                <th class="pb-3 px-3 text-sm text-left border-b border-grey">Reservation</th>

                                <th class="pb-3 px-5 text-sm text-left border-b border-grey">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                           foreach($voitures as $voit){
                            ?>
                             <tr>
                                <td class="py-4 px-3">
                                    <?php echo $voit['NumImmatriculation'] ?>
                                </td>
                                <td class="py-4 px-3">
                                    <img style="max-width:70px;max-higth:70px;" src=" <?php echo $voit['Image'] ?>"  alt="">
                                   
                                </td>        
                                <td class="py-4 px-3">  <?php echo $voit['Marque'] ?></td>
                                <td class="py-4 px-3">  <?php echo $voit['Modele'] ?></td>
                                <td class="py-4 px-3">  <?php echo $voit['Annee'] ?></td>
                                <td class="py-4 px-3">  <?php echo $voit['avaliable'] ?></td>
                                <td class="py-4 px-3 edit-button" > 
                                <a href="listCars.php?NumEdit=<?php echo $voit['NumImmatriculation']; ?>" class="edit-btn"><i class='bx bx-edit-alt'></i>  </a>
                                <a href=".././controllers/controlCar.php?NumImmatriculation=<?php echo $voit['NumImmatriculation'] ?>"><i class="fa-solid fa-trash"></i></a></td>
                            </tr>
                            <?php
                           }
                           ?>
                        </tbody>
  </table>
 </div>
 </div>
 </main>
</div>

<div id="addClientForm" class="add-client-form fixed  right-[-100%] w-full max-w-[400px] h-[580px] shadow-[2px_0_10px_rgba(0,0,0,0.1)] p-6 flex flex-col gap-5 transition-all duration-700 ease-in-out z-50 top-[166px]">
        <form action=".././controllers/controlCar.php" method="post"  class="flex flex-col gap-4">
            <h2 class="text-2xl font-semibold  mb-5">Add Car</h2>
            <div class="form-group flex flex-col">
                <label for="nummatrucle" class="text-sm text-gray-700 mb-1">Registration number </label>
                <input name="NumMatricle" type="text"  id="nummatrucle" placeholder="Enter the vehicle Sirie" class="p-2 border border-gray-300 rounded-lg outline-none text-sm" >
            </div>
            <div class="form-group flex flex-col">
                <label for="marque" class="text-sm text-gray-700 mb-1">Mark</label>
                <input name="Mark" type="text" id="marque" placeholder="Enter the vehicle Mark" class="p-2 border border-gray-300 rounded-lg outline-none text-sm" >
            </div>
            <div class="form-group flex flex-col">
                <label for="modele" class="text-sm text-gray-700 mb-1">Model</label>
                <input name="Model" type="text" id="modl" placeholder="Enter the vehicle Model" class="p-2 border border-gray-300 rounded-lg outline-none text-sm" >
            </div>
            <div class="form-group flex flex-col">
                <label for="year" class="text-sm text-gray-700 mb-1">Year</label>
                <input  type="number"   id="vehicleYear"   name="1"   min="2008"  max="2024"   required  placeholder="Enter the vehicle year" class="p-2 border border-gray-300 rounded-lg outline-none text-sm" >
            </div>
            <div class="form-group flex flex-col">
            <label for="carImage" class="text-sm text-gray-700 mb-1">Car Image</label>
          <input type="text" name="carImage" id="carImage" accept="image/*" class="p-2 border border-gray-300 rounded-lg outline-none text-sm">
       </div>
            <button type="submit" class="submit-btn border-none px-4 py-2 rounded-lg cursor-pointer transition-all duration-500 ease-in-out" name="Add" >Add</button>
            <button type="button" id="closeForm" class="close-btn border-none px-4 py-2 rounded-lg cursor-pointer transition-all duration-500 ease-in-out">Close</button>
      </form>
</div>

<div id="editform" class="add-client-form fixed  right-[-100%] w-full max-w-[400px] h-[580px] shadow-[2px_0_10px_rgba(0,0,0,0.1)] p-6 flex flex-col gap-5 transition-all duration-700 ease-in-out z-50 top-[166px]">
<form action=".././controllers/controlCar.php?Numedit=<?php echo $val[0]['NumImmatriculation'] ?>" method="post"  class="flex flex-col gap-4">
<h2 class="text-2xl font-semibold  mb-5">Update Car</h2>
            <div class="form-group flex flex-col">
                <label for="nummatrucle" class="text-sm text-gray-700  mb-1">New Registration number</label>
                <input name="NumMatricle" type="text"  id="nummatrucle" placeholder="Enter the vehicle Sirie" class="p-2 border border-gray-300 rounded-lg outline-none text-sm" value="<?php if(isset($val[0]['NumImmatriculation'])) echo $val[0]['NumImmatriculation']?>">
            </div>
            <div class="form-group flex flex-col">
                <label for="marque" class="text-sm text-gray-700 mb-1">New Mark</label>
                <input name="Mark" type="text" id="marque" placeholder="Enter the vehicle Mark" class="p-2 border border-gray-300 rounded-lg outline-none text-sm" value="<?php if(isset($val[0]['Marque'])) echo $val[0]['Marque']?>">
            </div>
            <div class="form-group flex flex-col">
                <label for="Model" class="text-sm text-gray-700 mb-1">New Model</label>
                <input name="Model" type="text" id="Model" placeholder="Enter the vehicle Model" class="p-2 border border-gray-300 rounded-lg outline-none text-sm" value="<?php if(isset($val[0]['Modele'])) echo $val[0]['Modele']?>">
            </div>
           <div class="form-group flex flex-col">
                <label for="year" class="text-sm text-gray-700 mb-1">New Year</label>
                <input  type="number"   id="vehicleYear"   name="vehYear"   min="2008"  max="2024"   required  placeholder="Enter the vehicle year" class="p-2 border border-gray-300 rounded-lg outline-none text-sm" value="<?php if(isset($val[0]['Annee'])) echo $val[0]['Annee']?>">
            </div>
            <div class="form-group flex flex-col">
            <label for="carImage" class="text-sm text-gray-700 mb-1">Car Image</label>
          <input type="text" name="carImage" id="carImage" accept="image/*" class="p-2 border border-gray-300 rounded-lg outline-none text-sm" value="<?php if(isset($val[0]['Image'])) echo $val[0]['Image']?>">
       </div>
            <button type="submit" class="submit-btn border-none px-4 py-2 rounded-lg cursor-pointer transition-all duration-500 ease-in-out" name="editveh">Edit</button>
            <button type="button" id="colseedit" class="close-btn border-none px-4 py-2 rounded-lg cursor-pointer transition-all duration-500 ease-in-out">Close</button>
      </form>
</div> 

 
 <script src=".././assets/main.js"></script>
</body>

</html>

