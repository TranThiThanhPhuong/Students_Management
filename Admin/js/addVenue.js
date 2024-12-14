const addClass1 = document.getElementById('addClass1');
const addClass2 = document.getElementById('addClass2');
const addRoomForm = document.getElementById('addRoomForm');
const overlay = document.getElementById('overlay');

addClass1.addEventListener('click', function() {
    addRoomForm.style.display = 'block';
    overlay.style.display = 'block';
    document.body.style.overflow = 'hidden';
});

addClass2.addEventListener('click', function() {
    addRoomForm.style.display = 'block';
    overlay.style.display = 'block';
    document.body.style.overflow = 'hidden';
});

var btnCloses = document.querySelectorAll('#addRoomForm .btnClose');
btnCloses.forEach(function(btnClose){
    btnClose.addEventListener('click', function(){
        addRoomForm.style.display = 'none';
        overlay.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
});