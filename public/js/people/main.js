document.addEventListener('DOMContentLoaded', function () {

    document.querySelector('#save-person').addEventListener('click', function () {

        let id = document.querySelector('#id').value;
        let name = document.querySelector('#name').value;
        let lastName = document.querySelector('#last-name').value;
        let middleName = document.querySelector('#middle-name').value;
        let age = document.querySelector('#age').value;
        let genderId = document.querySelector('#gender').value;
        let  puesto = document.querySelector('#puesto').value;

        let formData = new FormData();
        formData.append('id', id);
        formData.append('name', name);
        formData.append('last_name', lastName);
        formData.append('middle_name', middleName);
        formData.append('age', age);
        formData.append('puesto', puesto);
        formData.append('gender_id', genderId);

        fetch('http://localhost:8080/people/storeOrUpdate', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {

                Swal.fire({
                    icon: "success",
                    title: data.message,
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });

            })
            .catch(error => {
                console.error('Error al realizar la solicitud:', error);
            });

    });

});


const editPerson = (id) => {

    const modal = new bootstrap.Modal(document.getElementById('person-Modal'));

    fetch(`http://localhost:8080/people/${id}`)
        .then(response => response.json())
        .then(result => {
            let {data} = result
            document.getElementById('id').value = data.id;
            document.getElementById('name').value = data.name;
            document.getElementById('last-name').value = data.last_name;
            document.getElementById('middle-name').value = data.middle_name;
            document.getElementById('age').value = data.age;
            document.getElementById('puesto').value = data.puesto;

            let miSelect = document.getElementById('gender');

            for (let i = 0; i < miSelect.options.length; i++) {
                if (miSelect.options[i].value === data.gender_id) {
                    miSelect.selectedIndex = i;
                    break;
                }
            }
        })
        .catch(error => console.log('error', error));

    modal.show();

}


const openModal = () => {
    const modal = new bootstrap.Modal(document.getElementById('person-Modal'));
    modal.show();
}