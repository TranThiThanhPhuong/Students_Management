const addStudent = document.getElementById('addStudent');
const addStudentForm = document.getElementById('addStudentForm');
const overlay = document.getElementById('overlay');

addStudent.addEventListener("click", function(){
    addStudentForm.style.display = "block";
    overlay.style.display = "block";
    document.body.style.overflow = "hidden";
}) ;

var btnCloses = document.querySelectorAll(' #addStudentForm .btnClose ');

btnCloses.forEach(function(btnClose){
    btnClose.addEventListener('click', function(){
        addStudentForm.style.display = 'none';
        overlay.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
});

function openCamera(buttonId) {
    navigator.mediaDevices.getUserMedia({ video: true })
    .then((stream) => {
        const video = document.createElement('video');
        video.srcObject = stream;
        document.body.appendChild(video);
        video.play();

        setTimeout(() => {
          const capturedImage = captureImage(video);
          stream.getTracks().forEach(track => track.stop());
          document.body.removeChild(video);

          const imgElement = document.getElementById(buttonId + '-stu-img');
          imgElement.src = capturedImage;
          const hiddenInput = document.getElementById(buttonId + '-stu-img-input');
          hiddenInput.value = capturedImage;

        }, 2000);  
    })
    .catch((error) => {
        console.error('Error accessing webcam:', error);
    });
}
function captureImage(video) {
    const canvas = document.createElement('canvas');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    const context = canvas.getContext('2d');

    context.drawImage(video, 0, 0, canvas.width, canvas.height);

    return canvas.toDataURL('image/png');
  }