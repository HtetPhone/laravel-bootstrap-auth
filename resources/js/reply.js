const rpBtn = document.querySelectorAll('.rp-btn');

rpBtn.forEach(btn => {
    btn.addEventListener('click', function() {
        btn.nextElementSibling.classList.toggle('d-none');
    })
}
);


const editBTn = document.querySelectorAll('.edit-btn') ;
const editBox = document.querySelectorAll('.edit-box') ;

editBTn.forEach(btn => {
    btn.addEventListener('click', function() {
        editBox.forEach(box => {
            if(btn.id == box.id) {
                box.classList.toggle('d-none');
            }
        })
    })
});
