$(document).ready(function(){

    const pageContainer = document.createElement('div');
    pageContainer.setAttribute('id', 'page_container');
    pageContainer.classList.add('d-flex', 'justify-content-center', 'pt-4')
    
    $('#product_container').append(pageContainer);

    // showProducts();

    let cardItem = $('#product_row #prod_item')
    let productAvailable = cardItem.length;
    let productOnPage = 4;
    cardItem.slice(productOnPage).hide();
    
    $('#page_container').pagination({
        
        // total wrap in present
        items: productAvailable,
        // item allowed on single page
        itemsOnPage: productOnPage,
        // style
        // cssStyle: "light-theme",

        // this is pagination feature
        onPageClick: function(pageNumber){
            
            let showForm = productOnPage * (pageNumber -1);
            let showTo = showForm + productOnPage;

            // hide everything
            cardItem.hide()
                // ...and then only show the rows
                .slice(showForm, showTo).show();

        }
    });

    $(".custom-file-input").on("change", function() {
        let fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    
});