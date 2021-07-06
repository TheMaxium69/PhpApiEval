//Verif JS
console.log("JavaScript Init");

//Recuperation des divs
const divRestaurants = document.querySelector('.restaurants');
const divPlats = document.querySelector('.plats');
const title = document.querySelector('h1');

//Lancement de la function par default
afficheTousLesRestaurants();


//Affichage de tout les restaurants
function afficheTousLesRestaurants(){
  let maRequete = new XMLHttpRequest();   
  maRequete.open('GET', 'http://localhost/PhpApiEval/Back/index.php?controller=restaurant&task=indexApi')
  maRequete.onload =  () => {
          let reponse = JSON.parse(maRequete.responseText)
          faireDesCardsRestaurants(reponse);
  }
        maRequete.send();
}

//Créer une carde pour chaque restaurants
function faireDesCardsRestaurants(mesRestaurants){
    title.innerHTML = "Tout Nos Restaurants";
    let cards = "";
    mesRestaurants.forEach(restaurant => {
        card = `<div class="col-4 p-3">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
            <h5 class="card-title">${restaurant.name}</h5>
            <p class="card-text">${restaurant.adresse}</p>
            <button value="${restaurant.id}" class="btn btn-primary showRestaurants">voir le carte</button>
            </div>
        </div>
    </div>`
        cards += card
        
        divRestaurants.innerHTML = cards
        divPlats.innerHTML = "";
    });
        document.querySelectorAll('.showRestaurants').forEach(bouton =>{
        bouton.addEventListener('click', event =>{
            afficheUnRestaurant(bouton.value);
        })
    })
}

//Affichage d'un restaurant
function afficheUnRestaurant(sonId){
    let maRequete = new XMLHttpRequest();
    maRequete.open('GET', `http://localhost/PhpApiEval/Back/index.php?controller=restaurant&task=showApi&id=${sonId}` )
    maRequete.onload =  () => {
            let response = JSON.parse(maRequete.responseText)
            let restaurant = response.restaurant   //objet restaurants
            let plats = response.plats   //tableau d'objets plats
            faireCardRestaurantEtCardsPlats(restaurant, plats)
    }
          maRequete.send();
}

//Créer une carde d'un restaurant et de tout ses plats
function faireCardRestaurantEtCardsPlats(restaurant, plats) {
    title.innerHTML = "le page d'un restaurant : " + restaurant.name;
    cardRestaurant = `<div class="col-4 p-3">
    <div class="card" style="width: 18rem;">
        <div class="card-body">
        <h5 class="card-title">${restaurant.name}</h5>
        <p class="card-text">${restaurant.adresse}</p>
        </div>
             <button class="btn btn-success retourRestaurants">Retour aux Restaurants</button></div> </div>`;
  
    divRestaurants.innerHTML = cardRestaurant;
  
    
    cardsPlats = "";
    plats.forEach(plat => {
        cardPlat = `<div class="col-4 p-3" data-plat="${plat.id}">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
            <h5 class="card-title">${plat.name}</h5>
            <p class="card-text">${plat.price} euro</p>
            <p class="card-text">${plat.description}</p>
            </div>  
            <button value="${plat.id}" class="btn btn-danger delPlat">Supprimer le plat</button>  </div> </div>`;
        
        cardsPlats += cardPlat;
    })
  
    divPlats.innerHTML = cardsPlats;
  
    //Button pour revenir sur tout le restaurants
    document.querySelector('.retourRestaurants').addEventListener('click', event => {
        afficheTousLesRestaurants()
    })
    
    //Button pour lancer la suppresion d'un plat
    document.querySelectorAll('.delPlat').forEach(bouton =>{
        bouton.addEventListener('click', event =>{
            supprimerUnPlat(bouton.value)
        })
    })
  } 

  //Suppression d'un plat
function supprimerUnPlat(platId){
    params= "id="+platId;

    let maRequete = new XMLHttpRequest();
    maRequete.open('POST', `http://localhost/PhpApiEval/Back/index.php?controller=plat&task=suppApi` )
    maRequete.onload =  () => {
      let divPlat = document.querySelector(`div[data-plat="${platId}"]`)
      divPlat.remove()
    }
    maRequete.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    maRequete.send(params);
  } 
