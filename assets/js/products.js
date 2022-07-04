export let renderProducts = () => {

    let addProducts = document.querySelectorAll(".add-product");

    addProducts.forEach(addProduct => {

        addProduct.addEventListener("click", (event) => {
            
            console.log(addProduct);
            //Una llama async va acompañada de una await. 
            let sendPostRequest = async () => {

                //variable de tipo json. clave, valor
                let data = {};
                data["route"] = 'addProduct';
                data["price_id"] = addProduct.dataset.price;
                data["table_id"] = addProduct.dataset.table;
    
                //Se envia la peticion al servidor. Todas las llamadas irán a web.php de forma centralizada.
                let response = await fetch('web.php', {
                    headers: {
                        'Accept': 'application/json',
                    },
                    method: 'POST',
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
                    console.log(JSON.stringify(error));
                });
            };
    
            sendPostRequest();
        }); 
    });
        

};