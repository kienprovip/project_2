var el = document.getElementById("wrapper");
var toggleButton = document.getElementById("menu-toggle");

toggleButton.onclick = function () {
    el.classList.toggle("toggled");
}

var navbarHeight = document.querySelector('.navbar');
var chatHeight = document.querySelector('.chat');

// Ensure the elements are found before proceeding
if (navbarHeight && chatHeight) {
    // Calculate the height dynamically
    chatHeight.style.height = 'calc(100vh - (' + navbarHeight.clientHeight + 'px))';
}

var chatContentHeight = document.querySelector('.message-content');
var listCustomerHeignt = document.querySelector('.list-customer_message');

if (listCustomerHeignt) {
    if (listCustomerHeignt.clientHeight >= (window.innerHeight - navbarHeight.clientHeight)) {
        listCustomerHeignt.style.maxHeight = 'calc(100vh - (' + navbarHeight.clientHeight + 'px))';
        listCustomerHeignt.style.overflowY = 'auto';
    }
}

if (chatContentHeight) {

    // Use clientHeight to get the computed height of the element
    if (chatContentHeight.clientHeight >= (window.innerHeight - navbarHeight.clientHeight)) {
        chatContentHeight.style.maxHeight = 'calc(100vh - (' + navbarHeight.clientHeight + 'px))';
        chatContentHeight.style.overflowY = 'auto';
    }
}


var updateProductButton = document.querySelector('.click-update_product');
var updateProductShow = document.querySelector('.update-product_show');
var closeUpdateProductButton = document.querySelector('.close-update_product');

updateProductButton.addEventListener('click', function () {
    updateProductShow.style.display = 'block';
});

closeUpdateProductButton.addEventListener('click', function () {
    updateProductShow.style.display = 'none';
});


var addProductButton = document.querySelector('.click-add_product');
var addProductShow = document.querySelector('.add-product_show');
var closeAddProductButton = document.querySelector('.close-add_product');

addProductButton.addEventListener('click', function () {
    addProductShow.style.display = 'block';
});

closeAddProductButton.addEventListener('click', function () {
    addProductShow.style.display = 'none';
});


var dashboardClick = document.querySelector('.dashboard-click');
var analyticsClick = document.querySelector('.analytics-click');
var productsClick = document.querySelector('.products-click');
var chatClick = document.querySelector('.chat-click');
var mapClick = document.querySelector('.map-click');

// Function to reset colors
function resetColors() {
    dashboardClick.style.color = '#bbbec5';
    analyticsClick.style.color = '#bbbec5';
    productsClick.style.color = '#bbbec5';
    chatClick.style.color = '#bbbec5';
    mapClick.style.color = '#bbbec5';
}

// Add click event listeners to each button
dashboardClick.addEventListener('click', function () {
    resetColors(); // Reset colors for all buttons
    dashboardClick.style.color = '#009d63';
});

analyticsClick.addEventListener('click', function () {
    resetColors(); // Reset colors for all buttons
    analyticsClick.style.color = '#009d63';
});

productsClick.addEventListener('click', function () {
    resetColors(); // Reset colors for all buttons
    productsClick.style.color = '#009d63';
});

chatClick.addEventListener('click', function () {
    resetColors(); // Reset colors for all buttons
    chatClick.style.color = '#009d63';
});

mapClick.addEventListener('click', function () {
    resetColors(); // Reset colors for all buttons
    mapClick.style.color = '#009d63';
});
