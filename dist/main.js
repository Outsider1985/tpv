(()=>{"use strict";let e=()=>{let t=document.querySelectorAll(".delete-table-button"),n=document.querySelector(".delete-table-modal"),o=document.querySelectorAll(".edit-table-button");document.addEventListener("renderAdminTable",(t=>{e()}),{once:!0}),t.forEach((e=>{e.addEventListener("click",(t=>{n.dataset.id=e.dataset.id}))})),n&&n.addEventListener("click",(e=>{(async()=>{let e={};e.route=n.dataset.route,e.id=n.dataset.id,await fetch("web.php",{headers:{Accept:"application/json"},method:"DELETE",body:JSON.stringify(e)}).then((e=>{if(!e.ok)throw e;return e.json()})).then((e=>{document.querySelector("[data-element='"+e.id+"']").remove()})).catch((e=>{console.log(e)}))})()})),o.forEach((e=>{e.addEventListener("click",(t=>{(async()=>{let t={};t.route=e.dataset.route,t.id=e.dataset.id,await fetch("web.php",{headers:{Accept:"application/json"},method:"POST",body:JSON.stringify(t)}).then((e=>{if(!e.ok)throw e;return e.json()})).then((e=>{Object.entries(e.element).forEach((([e,t])=>{document.getElementsByName(e).length>0&&(document.getElementsByName(e)[0].value=t)}))})).catch((e=>{console.log(e)}))})()}))}))};document.querySelectorAll(".add-product").forEach((e=>{e.addEventListener("click",(t=>{console.log(e),(async()=>{let t={route:"addProduct"};t.price_id=e.dataset.price,t.table_id=e.dataset.table,await fetch("web.php",{headers:{Accept:"application/json"},method:"POST",body:JSON.stringify(t)}).then((e=>{if(!e.ok)throw e;return e.json()})).then((e=>{})).catch((e=>{console.log(JSON.stringify(e))}))})()}))})),(()=>{let e=document.querySelectorAll(".delete-product"),t=document.querySelector(".delete-all-products");e.forEach((e=>{e.addEventListener("click",(t=>{(async()=>{let t={route:"deleteProduct"};t.ticket_id=e.dataset.ticket,t.table_id=e.dataset.table,await fetch("web.php",{headers:{Accept:"application/json"},method:"DELETE",body:JSON.stringify(t)}).then((e=>{if(!e.ok)throw e;return e.json()})).then((e=>{})).catch((e=>{console.log(e)}))})()}))})),t&&t.addEventListener("click",(e=>{(async()=>{let e={route:"deleteAllProducts"};e.table_id=t.dataset.table,await fetch("web.php",{headers:{Accept:"application/json"},method:"DELETE",body:JSON.stringify(e)}).then((e=>{if(!e.ok)throw e;return e.json()})).then((e=>{})).catch((e=>{console.log(JSON.stringify(e))}))})()}))})(),(()=>{let e=document.querySelector(".admin-form"),t=document.querySelector(".create-form-button"),n=document.querySelector(".send-form-button"),o=document.querySelector(".create-layout"),c=document.querySelector("tbody");t&&t.addEventListener("click",(t=>{document.getElementsByName("id")[0].value="",e.reset()})),n&&n.addEventListener("click",(t=>{t.preventDefault(),(async()=>{let t={},n=new FormData(e);n.append("route",e.dataset.route),n.forEach((function(e,n){t[n]=e})),await fetch("web.php",{headers:{Accept:"application/json"},method:"POST",body:JSON.stringify(t)}).then((e=>{if(!e.ok)throw e;return e.json()})).then((e=>{if(""==e.id){let t=o.cloneNode(!0);t.classList.remove("d-none","create-layout"),t.dataset.element=e.newElement.id,t.querySelector(".delete-table-button").dataset.id=e.newElement.id,t.querySelector(".edit-table-button").dataset.id=e.newElement.id,Object.entries(e.newElement).forEach((([e,n])=>{t.querySelector("."+e)&&(t.querySelector("."+e).innerHTML=n)})),c.appendChild(t),document.dispatchEvent(new CustomEvent("renderAdminTable"))}else{let t=document.querySelector("[data-element='"+e.id+"']");Object.entries(e.newElement).forEach((([e,n])=>{t.querySelector("."+e)&&(t.querySelector("."+e).innerHTML=n)})),document.dispatchEvent(new CustomEvent("renderAdminTable"))}})).catch((e=>{console.log(e)}))})()}))})(),e()})();