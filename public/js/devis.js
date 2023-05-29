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
    <div id="server${counter}" class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3" style="opacity: 0;">
      <div class="panel panel-default fadeInDown border panel-primary rounded px-2 py-4 pt-2">
        <div class="panel-heading text-end"><button id="${counter}" class="btn btn-danger mt-0 mb-2" onclick="deleteServer(this)" type="button" ><i class="bi bi-x"></i></button></div>
          <table class="table-responsive overflow-hidden">
          `
  for (const x of services) {
    const idqte = `${counter}qte${x['id']}`;
    const idtotal = `${counter}total${x['id']}`;
    const idprix = `${counter}prix${x['id']}`;
    const prix = x["prix_unitaire"]

    html += `
    <tr class="text-start">
      <td scope="col" class="col-4 m-0 p-0 text-nowrap"><label class="form-control pe-0 m-0 overflow-hidden" style="border-radius:10px 0 0 10px !important">${x['nom']}</label></td>
      <td scope="col" class="col-2 m-0 p-0 text-nowrap"><input id=${idqte} class="form-control m-0 overflow-hidden" style="border-radius:0 !important" type="number" value=0 onblur="updateTotal(${counter},${x['id']})" onclick="updateTotal(${counter},${x['id']})"></td>
      <td scope="col" class="col-3 m-0 p-0 text-nowrap"><input id=${idprix} class="form-control m-0 overflow-hidden" style="border-radius:0 !important" type="decimal" value=${prix} onblur="updateTotal(${counter},${x['id']})" ></td>
      <td scope="col" class="col-3 m-0 p-0 text-nowrap"><input id=${idtotal} class="form-control m-0 overflow-hidden" style="border-radius:0 10px 10px 0 !important" type="decimal" onblur="checkTotal(${counter})" value=0></td>
    </tr>
    `;
  }
  html += `
    </table>
    <div class="panel d-flex justify-content-between pt-3">
      <div class="col-2 text-start fw-bold pt-1">Total </div>
      <div class="col-8"><input id="total${counter}" class="ps-1 fw-normal form-control" type="decimal" onblur="check()" value="0"></div>
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
}

function addServer_wthstuff(data) {
  let vari = data.serveur['prix']
  let html = `
    <div id="server${counter}" class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3" style="opacity: 0;">
      <div class="panel panel-default fadeInDown border panel-primary rounded px-2 py-4 pt-2">
        <div class="panel-heading text-end"><button id="${counter}" class="btn btn-danger mt-0 mb-2" onclick="deleteServer(this)" type="button" ><i class="bi bi-x"></i></button></div>
          <table class="table-responsive overflow-hidden">
          `
  for (const x of data.specifications) {
    const idqte = `${counter}qte${x['id_service']}`;
    const idtotal = `${counter}total${x['id_service']}`;
    const idprix = `${counter}prix${x['id_service']}`;
    const prix = x["prix_unitaire"]

    html += `
    <tr class="text-start">
      <td scope="col" class="col-4 m-0 p-0 text-nowrap"><label class="form-control pe-0 m-0 overflow-hidden" style="border-radius:10px 0 0 10px !important">${extractNomById(services_del, x['id_service'])}</label></td>
      <td scope="col" class="col-2 m-0 p-0 text-nowrap"><input id=${idqte} class="form-control m-0 overflow-hidden" style="border-radius:0 !important" type="number" value=${x['quantite']} onblur="updateTotal(${counter},${x['id_service']})" onclick="updateTotal(${counter},${x['id_service']})"></td>
      <td scope="col" class="col-3 m-0 p-0 text-nowrap"><input id=${idprix} class="form-control m-0 overflow-hidden" style="border-radius:0 !important" type="decimal" value=${x["prix_unitaire"]} onblur="updateTotal(${counter},${x['id_service']})" ></td>
      <td scope="col" class="col-3 m-0 p-0 text-nowrap"><input id=${idtotal} class="form-control m-0 overflow-hidden" style="border-radius:0 10px 10px 0 !important" type="decimal" onblur="checkTotal(${counter})" value=${x['prix']}></td>
    </tr>
    `;
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