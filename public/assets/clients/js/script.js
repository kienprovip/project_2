// click filter's mobile
function toggleFilter() {
    var filterElement = document.querySelector('.product-filter-d');
    if (filterElement.style.display === "none" || filterElement.style.display === "") {
        filterElement.style.display = "block";
    } else {
        filterElement.style.display = "none";
    }
}
// ************************


// click customer user icon
function toggleUser() {
    var UserElement = document.querySelector('.user-show');
    var customerMessageElement = document.querySelector('.customerMessage-show');
    var customerNotificationElement = document.querySelector('.customerNotification-show');
    if (UserElement.style.display === "none" || UserElement.style.display === "") {
        UserElement.style.display = "block";
        customerMessageElement.style.display = "none";
        customerNotificationElement.style.display = "none";
    } else {
        UserElement.style.display = "none";
    }
}
// ************************


// click customer notification icon
function toggleCustomerBell() {
    var customerMessageElement = document.querySelector('.customerMessage-show');
    var UserElement = document.querySelector('.user-show');
    var CustomerNotificationElement = document.querySelector('.customerNotification-show');
    if (CustomerNotificationElement.style.display === "none" || CustomerNotificationElement.style.display === "") {
        CustomerNotificationElement.style.display = "block";
        UserElement.style.display = "none";
        customerMessageElement.style.display = "none";
    } else {
        CustomerNotificationElement.style.display = "none";
    }
}
// **********************************



// click admin message icon
function toggleAdminMessage() {
    var adminMessageElement = document.querySelector('.adminMessage-show');
    var AdminNotificationElement = document.querySelector('.adminNotification-show');
    if (adminMessageElement.style.display === "none" || adminMessageElement.style.display === "") {
        adminMessageElement.style.display = "block";
        AdminNotificationElement.style.display = "none";
    } else {
        adminMessageElement.style.display = "none";
    }
}
// *******************************



// click admin notification icon
function toggleAdminBell() {
    var adminMessageElement = document.querySelector('.adminMessage-show');
    var adminNotificationElement = document.querySelector('.adminNotification-show');
    if (adminNotificationElement.style.display === "none" || adminNotificationElement.style.display === "") {
        adminNotificationElement.style.display = "block";
        adminMessageElement.style.display = "none";
    } else {
        adminNotificationElement.style.display = "none";
    }
}
// **********************************


// default scroll
window.onscroll = function () {
    var elementUser = document.getElementById('user-show-scroll');
    var elementCustomerMessage = document.getElementById('customerMessage-show-scroll');
    var elementCustomerNotification = document.getElementById('customerNotification-show-scroll');
    if (window.scrollY > 0) {
        elementUser.style.position = 'fixed';
        elementUser.style.top = '114px';
        elementCustomerMessage.style.position = 'fixed';
        elementCustomerMessage.style.top = '114px';
        elementCustomerNotification.style.position = 'fixed';
        elementCustomerNotification.style.top = '114px';
    }
};
// ************************


// product detail tablist
var DescriptionElement = document.querySelector('.description-content');
var ReviewsEmement = document.querySelector('.reviews-content');
function toggleDescription() {
    if (DescriptionElement.style.display === 'none') {
        DescriptionElement.style.display = 'block';
        ReviewsEmement.style.display = 'none';
        DescriptionElement.style.background = 'none';
        ReviewsEmement.style.backgroundColor = '--main-color';
    }
    else {
        DescriptionElement.style.display = 'block';
        ReviewsEmement.style.display = 'none';
    }
}

function toggleReviews() {
    if (ReviewsEmement.style.display === 'none') {
        DescriptionElement.style.display = 'none';
        ReviewsEmement.style.display = 'block';
    }
    else {
        DescriptionElement.style.display = 'none';
        ReviewsEmement.style.display = 'block';
    }
}
// ************************




// orders tablist
var AllOrdersElement = document.querySelector('.all-orders-content');
var ShippingOrdersEmement = document.querySelector('.shipping-orders-content');
var DeliveriedOrdersEmement = document.querySelector('.deliveried-orders-content');
var ProcessingOrdersElement = document.querySelector('.processing-orders-content');
var CanceledOrdersElement = document.querySelector('.canceled-orders-content');
function toggleAllOrders() {
    if (AllOrdersElement.style.display === 'none') {
        ShippingOrdersEmement.style.display = 'none';
        DeliveriedOrdersEmement.style.display = 'none';
        ProcessingOrdersElement.style.display = 'none';
        CanceledOrdersElement.style.display = 'none';
        AllOrdersElement.style.display = 'block';
    }
    else {
        AllOrdersElement.style.display = 'block';
        DeliveriedOrdersEmement.style.display = 'none';
        ShippingOrdersEmement.style.display = 'none';
        ProcessingOrdersElement.style.display = 'none';
        CanceledOrdersElement.style.display = 'none';
    }
}

function toggleShippingOrders() {
    if (ShippingOrdersEmement.style.display === 'none') {
        ShippingOrdersEmement.style.display = 'block';
        DeliveriedOrdersEmement.style.display = 'none';
        ProcessingOrdersElement.style.display = 'none';
        CanceledOrdersElement.style.display = 'none';
        AllOrdersElement.style.display = 'none';
    }
    else {
        ShippingOrdersEmement.style.display = 'block';
        DeliveriedOrdersEmement.style.display = 'none';
        ProcessingOrdersElement.style.display = 'none';
        CanceledOrdersElement.style.display = 'none';
        AllOrdersElement.style.display = 'none';
    }
}

function toggleBeingProcessed() {
    if (DeliveriedOrdersEmement.style.display === 'none') {
        ShippingOrdersEmement.style.display = 'none';
        ProcessingOrdersElement.style.display = 'block';
        DeliveriedOrdersEmement.style.display = 'none';
        CanceledOrdersElement.style.display = 'none';
        AllOrdersElement.style.display = 'none';
    }
    else {
        ShippingOrdersEmement.style.display = 'none';
        DeliveriedOrdersEmement.style.display = 'none';
        ProcessingOrdersElement.style.display = 'block';
        AllOrdersElement.style.display = 'none';
        CanceledOrdersElement.style.display = 'none';
    }
}

function toggleDeliveriedOrders() {
    if (DeliveriedOrdersEmement.style.display === 'none') {
        ShippingOrdersEmement.style.display = 'none';
        ProcessingOrdersElement.style.display = 'none';
        DeliveriedOrdersEmement.style.display = 'block';
        AllOrdersElement.style.display = 'none';
        CanceledOrdersElement.style.display = 'none';
    }
    else {
        ShippingOrdersEmement.style.display = 'none';
        DeliveriedOrdersEmement.style.display = 'block';
        ProcessingOrdersElement.style.display = 'none';
        AllOrdersElement.style.display = 'none';
        CanceledOrdersElement.style.display = 'none';
    }
}
function toggleCanceledOrders() {
    if (CanceledOrdersElement.style.display === 'none') {
        ShippingOrdersEmement.style.display = 'none';
        ProcessingOrdersElement.style.display = 'none';
        DeliveriedOrdersEmement.style.display = 'none';
        AllOrdersElement.style.display = 'none';
        CanceledOrdersElement.style.display = 'block';
    }
    else {
        ShippingOrdersEmement.style.display = 'none';
        DeliveriedOrdersEmement.style.display = 'none';
        ProcessingOrdersElement.style.display = 'none';
        AllOrdersElement.style.display = 'none';
        CanceledOrdersElement.style.display = 'block';
    }
}
// ************************

// toggle thumbnail product detail
var thumbnail0 = document.querySelector('.thumbnail-image0');
var thumbnail1 = document.querySelector('.thumbnail-image1');
var thumbnail2 = document.querySelector('.thumbnail-image2');
var thumbnail3 = document.querySelector('.thumbnail-image3');
var thumbnailShow = document.querySelector('.thumbnail-show');
function toggleThumbnail0() {
    thumbnailShow.src = thumbnail0.src;
}

function toggleThumbnail1() {
    thumbnailShow.src = thumbnail1.src;
}

function toggleThumbnail2() {
    thumbnailShow.src = thumbnail2.src;
}

function toggleThumbnail3() {
    thumbnailShow.src = thumbnail3.src;
}