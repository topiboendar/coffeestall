async function dummyData(){
    const response = await fetch("https://fake-coffee-api.vercel.app/api");
    const data = await response.json();
    return data;
}

async function showProducts(){
    const data = await dummyData();
    const insideCardContainer = document.getElementById('product_row');
    data.forEach(product => {

        const card = document.createElement('div');
        
        let priceInRp = product.price * 16000;

        let number_string = priceInRp .toString();
        let sisa = number_string.length % 3;
        let rupiah = number_string.slice(0, sisa);
        let ribuan = number_string.slice(sisa).match(/\d{3}/gi);

        if(ribuan){
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        card.classList.add('card');
        card.setAttribute('id', 'prod_item')
        card.innerHTML = (`
            <img class="card-img-top" id="img_product" src="${product.image_url}" alt="${product.name}">
            <div class="card-body text-center mt-auto">
                <h5 id="name_product" class="card-title">${product.name}</h5>
                <p id="flavour_prod" class="card-text">${product.flavor_profile}</p>
                <p id="price_tag" class="font-weight-bold">Rp${rupiah}</p>
            </div>
            <div class="card-footer border-0 bg-white">
                <button class="btn btn-outline-dark w-100">+ Keranjang</button>
            </div>
        `);
        insideCardContainer.appendChild(card)

    });

    

}