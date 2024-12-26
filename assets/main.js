let sideLinks = document.querySelectorAll('.sidebar .side-menu li a:not(.logout)');
sideLinks.forEach(item => {
    const li = item.parentElement;
    item.addEventListener('click', (e) => {

        sideLinks.forEach(i => {
            i.parentElement.classList.remove('active');
        })
        li.classList.add('active');
    })
});

let menuBar = document.querySelector('.content nav .bx.bx-menu');
let sideBar = document.querySelector('.sidebar');
menuBar.addEventListener('click', (e) => {
    e.preventDefault();
    sideBar.classList.toggle('close');
});

let searchBtn = document.querySelector('.content nav form .form-input button');
let searchBtnIcon = document.querySelector('.content nav form .form-input button .bx');
let searchForm = document.querySelector('.content nav form');
searchBtn.addEventListener('click', function(e) {
    if (window.innerWidth < 576) {
        e.preventDefault;
        searchForm.classList.toggle('show');
        if (searchForm.classList.contains('show')) {
            searchBtnIcon.classList.replace('bx-search', 'bx-x');
        } else {
            searchBtnIcon.classList.replace('bx-x', 'bx-search');
        }
    }
});
window.addEventListener('resize', () => {
    if (window.innerWidth < 768) {
        sideBar.classList.add('close');
    } else {
        sideBar.classList.remove('close');
    }
    if (window.innerWidth > 576) {
        searchBtnIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
});
const toggler = document.getElementById('theme-toggle');

toggler.addEventListener('change', function() {
    if (this.checked) {
        document.body.classList.add('dark');
    } else {
        document.body.classList.remove('dark');
    }
});


document.getElementById('buttonadd').addEventListener('click', function(e) {
    e.preventDefault()
    document.getElementById('addClientForm').classList.add('active');
});


document.getElementById('closeForm').addEventListener('click', function() {
        document.getElementById('addClientForm').classList.remove('active');
    })
    //fooor edit

document.getElementById('colseedit').addEventListener('click', function() {
    document.getElementById('editform').classList.remove('active');
    window.location.href = 'clients.php'
})

document.getElementById('colseedit').addEventListener('click', function() {
    document.getElementById('editformcar').classList.remove('active');

    window.location.href = 'cars.php'
})
document.getElementById('colseedit').addEventListener('click', function() {
    document.getElementById('editcontform').classList.remove('active');
    window.location.href = 'contrats.php'
})

document.querySelector(".DateDebut").addEventListener("change", calculateDuration);
document.querySelector(".DateFin").addEventListener("change", calculateDuration);

function calculateDuration() {
    let startDate = document.querySelector(".DateDebut").value;
    let endDate = document.querySelector(".DateFin").value;

    console.log(startDate);

    if (startDate && endDate) {
        let start = new Date(startDate);
        let end = new Date(endDate);
        let differenceInTime = end - start;
        let differenceInDays = differenceInTime / (1000 * 60 * 60 * 24);
        document.querySelector(".Duree").value = differenceInDays;
    } else {
        document.querySelector(".Duree").value = '';
    }
}
document.querySelector(".DateDebutt").addEventListener("change", calculateDuration);
document.querySelector(".DateFint").addEventListener("change", calculateDuration);

function calculateDuration() {
    let startDate = document.querySelector(".DateDebutt").value;
    let endDate = document.querySelector(".DateFint").value;

    console.log(startDate);

    if (startDate && endDate) {
        let start = new Date(startDate);
        let end = new Date(endDate);
        let differenceInTime = end - start;
        let differenceInDays = differenceInTime / (1000 * 60 * 60 * 24);
        document.querySelector(".Dureet").value = differenceInDays;
    } else {
        document.querySelector(".Dureet").value = '';
    }
}
// Script لإخفاء الـ Alert بعد 10 ثواني
document.addEventListener('DOMContentLoaded', function() {
    // نحدد العنصر ديال الـ Alert
    const alert = document.getElementById('alert-success');

    if (alert) {
        // نخليه يختفي بعد 10 ثواني
        setTimeout(function() {
            alert.classList.add('hidden'); // نضيف كلاس hidden باش نخبّيه
        }, 10000); // 10000ms = 10 ثواني

        // زر الإغلاق (إذا بغى المستخدم يسدّ يدوياً)
        const closeAlert = document.getElementById('close-alert');
        closeAlert.addEventListener('click', function() {
            alert.classList.add('hidden');
        });
    }
});