function updateTotal(serverid, id) {
  const qte = document.getElementById(`${serverid}qte${id}`).value;
  const prixUnitaire = document.getElementById(`${serverid}prix${id}`).value;;
  const total = qte * prixUnitaire;
  document.getElementById(`${serverid}total${id}`).value = total;

  let divElem = document.getElementById(`server${serverid}`);
  let inputElements = divElem.querySelectorAll(`[id^="${serverid}total"]`);

  let serverTotal = document.getElementById(`total${serverid}`);
  serverTotal.value = 0;

  for (const x of inputElements) {
    serverTotal.value = parseFloat(serverTotal.value) + parseFloat(x.value);
  }

  check()
}

function extractNomById(jsonData, id) {
  for (let i = 0; i < jsonData.length; i++) {
    if (jsonData[i].id === id) {
      return jsonData[i].nom;
    }
  }
  return null; // Return null if the id is not found
}
function extractDescById(jsonData, id) {
  for (let i = 0; i < jsonData.length; i++) {
    if (jsonData[i].id === id) {
      return jsonData[i].desc;
    }
  }
  return null; // Return null if the id is not found
}
function extractDelById(jsonData, id) {
  for (let i = 0; i < jsonData.length; i++) {
    if (jsonData[i].id === id) {
      console.log(jsonData[i])
      return jsonData[i].deleted_at;
    }
  }
  return null; // Return null if the id is not found
}

function checkTotal(serverid) {
  let divElem = document.getElementById(`server${serverid}`);
  let inputElements = divElem.querySelectorAll(`[id^="${serverid}total"]`);

  let serverTotal = document.getElementById(`total${serverid}`);
  serverTotal.value = 0;

  for (const x of inputElements) {
    serverTotal.value = parseFloat(serverTotal.value) + parseFloat(x.value);
  }

  check()
}

function check() {
  divElem = document.getElementById('servers-card');
  inputElements = divElem.querySelectorAll(`[id^="total"]`);
  let devisTotal = document.getElementById('total');

  devisTotal.value = 0
  for (const x of inputElements) {
    devisTotal.value = parseFloat(devisTotal.value) + parseFloat(x.value);
  }
}

function addServer() {
  let html = `
    <div id="server${counter}" class=" px-1 col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-3" style="opacity: 0;">
      <div class="card fadeInDown panel-primary text-">
        <div class="card-header bg-dark text-light text-start pe-4">
        <div class="row">
          <strong id="title" class="col-11 align-bottom">Serveur ${cnter}</strong>
          <button id="${counter}" class="col-1 btn btn-light " onclick="deleteServer(this)" type="button" ><i class="bi bi-x-lg"></i></button>
        </div></div>

        <div class="card-body">
        <table class="table-responsive-sm ">
          `
  for (const x of services) {
    const idqte = `${counter}qte${x['id']}`;
    const idtotal = `${counter}total${x['id']}`;
    const idprix = `${counter}prix${x['id']}`;
    const prix = x["prix_unitaire"]
    if (x['desc'] == "") {
        html += `
    <tr class="text-start">
      <td scope="col" class="col-lg-6 col-6 m-0 p-0 "><label class="pe-0 m-0 overflow-hidden border-none" style="">${x['nom']}</label></td>
      <td scope="col" class="col-lg-2 col-1 m-0 p-0 "><input  id=${idqte} class="form-control m-0 overflow-hidden " style="border-radius:0" type="number" value=0 onblur="updateTotal(${counter},${x['id']})" onclick="updateTotal(${counter},${x['id']})"></td>
      <td scope="col" class="col-lg-2 col-2 m-0 p-0 "><input  id=${idprix} class="form-control m-0 overflow-hidden " style="border-radius:0" type="decimal" value=${prix} onblur="updateTotal(${counter},${x['id']})" ></td>
      <td scope="col" class="col-lg-2 col-2 m-0 p-0 "><input  id=${idtotal} class="form-control m-0 overflow-hidden " style="border-radius:0" type="decimal" onblur="checkTotal(${counter})" value=0></td>
    </tr>
    `;
    } else {
      html += `
    <tr class="text-start">
      <td scope="col" class="col-lg-6 col-6 m-0 p-0"><label class="pe-0 m-0 border-none" style="border-radius:10px 0 0 10px !important">${x['nom']}(${x['desc']})</label></td>
      <td scope="col" class="col-lg-2 col-1 m-0 p-0 "><input id=${idqte} class="form-control m-0 overflow-hidden border-none" style="border-radius:0" type="number" value=0 onblur="updateTotal(${counter},${x['id']})" onclick="updateTotal(${counter},${x['id']})"></td>
      <td scope="col" class="col-lg-2 col-2 m-0 p-0 "><input id=${idprix} class="form-control m-0 overflow-hidden border-none" style="border-radius:0" type="decimal" value=${prix} onblur="updateTotal(${counter},${x['id']})" ></td>
      <td scope="col" class="col-lg-2 col-2 m-0 p-0 "><input id=${idtotal} class="form-control m-0 overflow-hidden border-none" style="border-radius:0" type="decimal" onblur="checkTotal(${counter})" value=0></td>
      </tr>
    `;
    }
    
  }
  html += `
    </table>
    <div class="panel d-flex justify-content-between pt-3">
      <div class="col-6 text-end fw-bold pt-1 me-2 pe-4">Total :</div>
      <div class="col-4"><input id="total${counter}" class="ps-2 fw-normal form-control ms-4" type="decimal" onblur="check()" value="0"></div>
      <div class="col-2 fw-normal text-center pt-1 pe-3">mad</div>
    </div>
    </div>
  </div>
  </div>`;
  const div = document.getElementById('servers-card');
  div.insertAdjacentHTML('beforeend', html);

  // Add animation for new server element
  const newServerElem = document.getElementById(`server${counter}`);
  newServerElem.animate([{
    opacity: '0'
  }, {
    opacity: '1'
  }], {
    duration: 500,
    fill: 'forwards'
  });
  cnter++;
  counter++;
}

function addServer_wthstuff(data) {
  let vari = data.serveur['prix']
  let html = `
    <div id="server${counter}" class=" px-1  col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-3" style="opacity: 0;">
      <div class="card fadeInDown panel-primary text-">
        <div class="card-header bg-dark text-light text-start pe-4">
        <div class="row">
          <strong id="title" class="col-11 align-bottom">Serveur ${cnter}</strong>
          <button id="${counter}" class="col-1 btn btn-light " onclick="deleteServer(this)" type="button" ><i class="bi bi-x-lg"></i></button>
        </div></div>

        <div class="card-body"><table class="table-responsive-sm ">
          `
  for (const x of data.specifications) {
    const idqte = `${counter}qte${x['id_service']}`;
    const idtotal = `${counter}total${x['id_service']}`;
    const idprix = `${counter}prix${x['id_service']}`;
    const prix = x["prix_unitaire"]
    if (extractDescById(services_del, x['id_service']) == "") {
      if (extractDelById(services_del, x['id_service'])== null) {
        html += `
    <tr class="text-start">
      <td scope="col" class="col-lg-6 col-6 m-0 p-0 "><label class="pe-0 m-0 border-none" >${extractNomById(services_del, x['id_service'])}</label></td>
      <td scope="col" class="col-lg-2 col-1 m-0 p-0 "><input  id=${idqte} class="form-control m-0 overflow-hidden border-none"  type="number" value="${x['quantite']}" onblur="updateTotal(${counter},${x['id_service']})" onclick="updateTotal(${counter},${x['id_service']})"></td>
      <td scope="col" class="col-lg-2 col-2 m-0 p-0 "><input  id=${idprix} class="form-control m-0 overflow-hidden border-none"  type="decimal" value="${x['prix_unitaire']}" onblur="updateTotal(${counter},${x['id_service']})" ></td>
      <td scope="col" class="col-lg-2 col-2 m-0 p-0 "><input  id=${idtotal} class="form-control m-0 overflow-hidden border-none"  type="decimal" onblur="checkTotal(${counter})" value="${x['prix']}"></td>
    </tr>
    `;
      } else {
         html += `
    <tr class="text-start">
      <td scope="col" class="col-lg-6 col-6 m-0 p-0  "><label class="pe-0 m-0 border-none text-decoration-line-through" >${extractNomById(services_del, x['id_service'])}</label></td>
      <td scope="col" class="col-lg-2 col-1 m-0 p-0  "><input  id=${idqte} class="form-control m-0 overflow-hidden border-none"  type="number" value="${x['quantite']}" onblur="updateTotal(${counter},${x['id_service']})" onclick="updateTotal(${counter},${x['id_service']})"></td>
      <td scope="col" class="col-lg-2 col-2 m-0 p-0  "><input  id=${idprix} class="form-control m-0 overflow-hidden border-none"  type="decimal" value="${x['prix_unitaire']}" onblur="updateTotal(${counter},${x['id_service']})" ></td>
      <td scope="col" class="col-lg-2 col-2 m-0 p-0  "><input  id=${idtotal} class="form-control m-0 overflow-hidden border-none"  type="decimal" onblur="checkTotal(${counter})" value="${x['prix']}"></td>
    </tr>
    `;
      }
    } else {
      if (extractDelById(services_del, x['id_service']) == null) {
        html += `
    <tr class="text-start">
      <td scope="col" class="col-lg-6 col-6 m-0 p-0 "><label class="pe-0 m-0 border-none" >${extractNomById(services_del, x['id_service'])}(${extractDescById(services_del, x['id_service'])})</label></td>
      <td scope="col" class="col-lg-2 col-1 m-0 p-0 text-nowrap"><input id=${idqte} class="form-control m-0 overflow-hidden border-none"  type="number" value="${x['quantite']}" onblur="updateTotal(${counter},${x['id_service']})" onclick="updateTotal(${counter},${x['id_service']})"></td>
      <td scope="col" class="col-lg-2 col-2 m-0 p-0 text-nowrap"><input id=${idprix} class="form-control m-0 overflow-hidden border-none"  type="decimal" value="${x['prix_unitaire']}" onblur="updateTotal(${counter},${x['id_service']})" ></td>
      <td scope="col" class="col-lg-2 col-2 m-0 p-0 text-nowrap"><input id=${idtotal} class="form-control m-0 overflow-hidden border-none"  type="decimal" onblur="checkTotal(${counter})" value="${x['prix']}"></td>
    </tr>
    `;
      } else {
        html += `
    <tr class="text-start">
      <td scope="col" class="col-lg-6 col-6 m-0 p-0 "><label class="pe-0 m-0 border-none text-decoration-line-through" >${extractNomById(services_del, x['id_service'])}(${extractDescById(services_del, x['id_service'])})</label></td>
      <td scope="col" class="col-lg-2 col-1 m-0 p-0 text-nowrap"><input id=${idqte} class="form-control m-0 overflow-hidden border-none"  type="number" value="${x['quantite']}" onblur="updateTotal(${counter},${x['id_service']})" onclick="updateTotal(${counter},${x['id_service']})"></td>
      <td scope="col" class="col-lg-2 col-2 m-0 p-0 text-nowrap"><input id=${idprix} class="form-control m-0 overflow-hidden border-none"  type="decimal" value="${x['prix_unitaire']}" onblur="updateTotal(${counter},${x['id_service']})" ></td>
      <td scope="col" class="col-lg-2 col-2 m-0 p-0 text-nowrap"><input id=${idtotal} class="form-control m-0 overflow-hidden border-none"  type="decimal" onblur="checkTotal(${counter})" value="${x['prix']}"></td>
    </tr>
    `;
      }
    }
  }
  html += `
    </table>
    <div class="panel d-flex justify-content-between pt-3">
      <div class="col-2 text-start fw-bold pt-1">Total </div>
      <div class="col-8"><input id="total${counter}" class="ps-1 fw-normal form-control" type="decimal" onblur="check()" value=${vari}></div>
      <div class="col-2 fw-normal text-center pt-1">MAD</div>
    </div>
  </div>
  </div>`;
  const div = document.getElementById('servers-card');
  div.insertAdjacentHTML('beforeend', html);

  // Add animation for new server element
  const newServerElem = document.getElementById(`server${counter}`);
  newServerElem.animate([{
    opacity: '0'
  }, {
    opacity: '1'
  }], {
    duration: 500,
    fill: 'forwards'
  });

  counter++;
  cnter++
}

function deleteServer(e) {
  const divElem = document.getElementById("server" + e.id);
  // Add animation for deleting server element
  divElem.animate([{
    opacity: '1'
  }, {
    opacity: '0'
  }], {
    duration: 350,
    fill: 'forwards'
  }).onfinish = () => {
    divElem.remove();
    // Update server count and ids of following servers
    let serverCount = document.querySelectorAll('[id^="server"]').length;
    for (let i = parseInt(e.id) + 1; i <= serverCount; i++) {
      const serverElem = document.getElementById(`server${i}`);
      if (serverElem) {
        serverElem.querySelectorAll(`[onblur^=updateTotal]`).forEach((elem) => {
          const regex = /updateTotal\((\d+),\s*(\d+)\)/;
          const matches = regex.exec(elem.getAttribute('onblur'));
          if (matches) {
            const firstParam = matches[2];
            elem.setAttribute("onclick", `updateTotal( ${parseInt(i) - 1},${firstParam})`);
            elem.setAttribute("onblur", `updateTotal( ${parseInt(i) - 1},${firstParam})`)
          }
        });
        serverElem.querySelectorAll(`[onblur^=checkTotal]`).forEach((elem) => {
          elem.setAttribute("onblur", `checkTotal( ${parseInt(i) - 1})`)
        });
        serverElem.querySelectorAll(`[id^="${i}"]`).forEach((elem) => {
          const newId = elem.id.replace(/^\d+/, i - 1);
          elem.id = newId;
        });
        serverElem.id = 'server' + (i - 1);
        const totalelem = document.getElementById('total' + i);
        if (totalelem) {
          const id = `total${i-1}`
          totalelem.id = id
        }
      }

    }
    // Update server counter
    counter--;
    check()
  }

}

function extractServer() {
  let divElem = document.getElementById('servers-card');
  let servers = [];
  const serverElems = divElem.querySelectorAll('[id^="server"]');
  for (i = 1; i <= serverElems.length; i++) {
    let j = 1;
    const inputs = serverElems[i - 1].querySelectorAll('input');
    const inputArray = Array.from(inputs);
    counter = inputArray.length - 1
    let server = [];
    for (k = 0; k < counter; k += 3) {
      const str = inputArray[k].id;
      const combinedObj = {
        Id_service: parseInt(str.match(/qte(\d+)/)[1]),
        quantite: inputArray[k].value,
        prix_unitaire: inputArray[k + 1].value,
        prix: inputArray[k + 2].value,
      };
      server.push(combinedObj)
      j++;
    }

    server.push({
      Id_serveur: i,
      prix: inputArray[inputArray.length - 1].value
    })
    servers.push({
      server
    })
    
  }
  return servers;
}

function extractDevis() {
  let nom = document.getElementById('nom');
  let description = document.getElementById('description');
  let prix = document.getElementById('total')
  return {
    "nom": nom.value,
    "prix": prix.value,
    "desc": description.value,
  }
}

