export let renderAdminForm = () => {

    let adminForm = document.querySelector('.admin-form');
    let createFormButton = document.querySelector('.create-form-button');
    let sendFormButton = document.querySelector('.send-form-button');
    let createLayout = document.querySelector('.create-layout');
    let tableContainer = document.querySelector('tbody');

    if(createFormButton) {
        
        createFormButton.addEventListener("click", (event) => {
            // Cuando hay un evento click en el botón de crear formulario lo primero que hace es resetear el formulario
            document.getElementsByName('id')[0].value = "";
            adminForm.reset();
        });
    }

    if(sendFormButton) {

        sendFormButton.addEventListener("click", (event) => {
            // Evita el comportamiento default del botón que enviaria los datos via GET. Asi evitamos que se envien los datos por GET
            event.preventDefault();
                
            let sendPostRequest = async () => {
                
                let data = {};
                // formData es un objeto nativo de JS que nos permite obtener los datos del formulario
                let formData = new FormData(adminForm);
                formData.append("route", adminForm.dataset.route);

                formData.forEach((value, key) => {

                    if(value instanceof File && value.size > 0) {

                        let file = {
                            'lastMod'    : value.lastModified,
                            'lastModDate': value.lastModifiedDate,
                            'name'       : value.name,
                            'size'       : value.size,
                            'type'       : value.type,
                        } 

                        data[key] = file;

                        fetch ('upload.php', {
                            method: 'POST',
                            body: formData
                        });
                    }
                    else {
                        data[key] = value;
                    }
                });

                let response = await fetch('web.php', {
                    headers: {
                        'Accept': 'application/json',
                    },
                    method: 'POST',
                    body: JSON.stringify(data)
                })
                .then(response => {
                
                    if (!response.ok) throw response;

                    return response.json();
                })
                .then(json => {

                    if(json.id == "") {

                        let newElement = createLayout.cloneNode(true);
                        newElement.classList.remove('d-none', 'create-layout');
                        newElement.dataset.element = json.newElement.id;

                        newElement.querySelector('.delete-table-button').dataset.id = json.newElement.id;
                        newElement.querySelector('.edit-table-button').dataset.id = json.newElement.id;

                        Object.entries(json.newElement).forEach(([key, value]) => {
                            
                            if(newElement.querySelector("." + key)){

                                if(newElement.querySelector("." + key).tagName == "IMG") {

                                    newElement.querySelector("." + key).src = value;
                                }else{
                                    newElement.querySelector("." + key).innerHTML = value;
                                }
                            }
                        });

                        tableContainer.appendChild(newElement);

                        document.dispatchEvent(new CustomEvent('renderAdminTable'));

                    }else{

                        let element = document.querySelector("[data-element='" + json.id + "']");

                        Object.entries(json.newElement).forEach(([key, value]) => {
                            
                            if(element.querySelector("." + key)){

                                if(element.querySelector("." + key).tagName == "IMG") {

                                    element.querySelector("." + key).src = value;
                                }else{
                                    element.querySelector("." + key).innerHTML = value;
                                }
                            }
                        });

                        document.dispatchEvent(new CustomEvent('renderAdminTable'));
                    }
                })
                .catch ( error =>  {
                    console.log(error);
                });
            };

            sendPostRequest();
        }); 
    }
    
};