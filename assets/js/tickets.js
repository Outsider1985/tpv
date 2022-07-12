export let renderTickets = () => {
    
    let deleteProducts = document.querySelectorAll(".delete-product");
    let deleteAllProducts = document.querySelector(".delete-all-products");

    deleteProducts.forEach(deleteProduct => {

        deleteProduct.addEventListener("click", (event) => {
            
            //Una llama async va acompañada de una await. 
            let sendPostRequest = async () => {

                //variable de tipo json. clave, valor
                let data = {};
                data["route"] = 'deleteProduct';
                data["ticket_id"] = deleteProduct.dataset.ticket;
                data["table_id"] = deleteProduct.dataset.table;
    
                //Se envia la peticion al servidor. Todas las llamadas irán a web.php de forma centralizada.
                let response = await fetch('web.php', {
                    headers: {
                        'Accept': 'application/json',
                    },
                    method: 'DELETE',
                    body: JSON.stringify(data)
                })
                //Then se ejecuta cuando la llamada async termina.
                .then(response => {
                
                    if (!response.ok) throw response;
    
                    return response.json();
                })
                .then(json => {

                })
                .catch ( error =>  {
                    console.log(error);
                });
            };
    
            sendPostRequest();
        }); 
    });

    if(deleteAllProducts){
             
        deleteAllProducts.addEventListener("click", (event) => {

            let sendPostRequest = async () => {

                let data = {};

                data["route"] = 'deleteAllProducts';
                data["table_id"] = deleteAllProducts.dataset.table;

                let response = await fetch('web.php', {
                    headers: {
                        'Accept': 'application/json',
                    },
                    method: 'DELETE',
                    body: JSON.stringify(data)
                })
                .then(response => {
                        
                        if (!response.ok) throw response;
        
                        return response.json();
                    })
                    .then(json => {

                    })
                    .catch ( error =>  {
                        console.log(JSON.stringify(error));
                    });
                };
                
                sendPostRequest();
            });  
            
        };
    }
    