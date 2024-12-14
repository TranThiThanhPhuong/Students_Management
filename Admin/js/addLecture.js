const addLecture = document.getElementById('addLecture');
const addLectureForm = document.getElementById('addLectureForm');

addLecture.addEventListener("click", function(){
    addLectureForm.style.display = "block";
    overlay.style.display = "block";
    document.body.style.overflow = "hidden";
}) ;

var btnCloses = document.querySelectorAll(' #addLectureForm .btnClose ');

btnCloses.forEach(function(btnClose){
    btnClose.addEventListener('click', function(){
        addLectureForm.style.display = 'none';
        overlay.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
});