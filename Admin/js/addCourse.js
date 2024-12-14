
const addCourseForm= document.getElementById("addCourseForm");
const addCourse = document.getElementById("addCourse");
const addUnit=document.getElementById('addUnit');
const overlay = document.querySelector('#overlay');

const addUnitForm=document.getElementById("addUnitForm")
const addFaculty=document.getElementById('addFaculty');
const addFacultyForm=document.getElementById("addFacultyForm");



addCourse.addEventListener("click", function() {
  addCourseForm.style.display = "block";
  overlay.style.display="block";
  document.body.style.overflow = 'hidden'; 
});

addUnit.addEventListener("click", function() {
    addUnitForm.style.display = "block";
    overlay.style.display="block";
    document.body.style.overflow = 'hidden'; 
  
  
  });

addFaculty.addEventListener("click", function() {
  addFacultyForm.style.display = "block";
  overlay.style.display="block";
  document.body.style.overflow = 'hidden'; 
});


  
var btnCloses = document.querySelectorAll('#addCourseForm .btnClose, #addUnitForm .btnClose, #addFacultyForm .btnClose ');

btnCloses.forEach(function(btnClose){
    btnClose.addEventListener('click', function(){
        addCourseForm.style.display = 'none';
        addUnitForm.style.display = 'none';
        addFacultyForm.style.display = 'none';
        overlay.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
});